# =============================
# 1. FRONTEND BUILD (Vite)
# =============================
FROM node:20 AS vite-builder
WORKDIR /app

# Copy package files
COPY package.json package-lock.json ./
RUN npm install

# Copy config files
COPY vite.config.js ./
COPY postcss.config.js ./
COPY tailwind.config.js ./

# Copy source files
COPY resources ./resources
COPY public ./public

# Build
RUN npm run build

# Debug: Show what was built
RUN echo "=== Vite build output ===" && \
    ls -laR public/build/ && \
    echo "=== End of build output ==="

# =============================
# 2. BACKEND BUILD (Laravel + Apache)
# =============================
FROM php:8.3-apache

RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf

RUN apt-get update && apt-get install -y \
    git curl unzip zip \
    libpng-dev libonig-dev libxml2-dev \
    libzip-dev libicu-dev libpq-dev && \
    apt-get clean && rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-install \
    pdo_pgsql pgsql mbstring exif pcntl \
    bcmath gd zip intl

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# Install PHP dependencies
COPY composer.json composer.lock ./
RUN composer install --optimize-autoloader --no-dev --no-scripts \
    || composer install --optimize-autoloader --no-dev --no-scripts --ignore-platform-reqs

# Copy application files
COPY . .

# Remove node_modules
RUN rm -rf node_modules

# Copy build directory
COPY --from=vite-builder /app/public/build ./public/build

# Create manifest.json if it doesn't exist (fallback)
RUN if [ ! -f /var/www/html/public/build/manifest.json ]; then \
        echo "Creating dummy manifest.json"; \
        mkdir -p /var/www/html/public/build && \
        echo '{}' > /var/www/html/public/build/manifest.json; \
    fi

RUN composer dump-autoload --optimize

# Configure Apache
ENV APACHE_DOCUMENT_ROOT=/var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' \
    /etc/apache2/sites-available/000-default.conf && \
    sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' \
    /etc/apache2/sites-available/default-ssl.conf 2>/dev/null || true

RUN printf "\n<Directory ${APACHE_DOCUMENT_ROOT}>\n\
    Options Indexes FollowSymLinks\n\
    AllowOverride All\n\
    Require all granted\n\
</Directory>\n" >> /etc/apache2/apache2.conf

RUN a2enmod rewrite

# Set permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html/storage \
    && chmod -R 755 /var/www/html/bootstrap/cache \
    && chmod -R 755 /var/www/html/public

# Configure port
RUN sed -i "s/Listen 80/Listen 10000/g" /etc/apache2/ports.conf && \
    sed -i "s/:80/:10000/g" /etc/apache2/sites-available/000-default.conf

EXPOSE 10000

CMD php artisan config:cache && \
    php artisan route:cache && \
    php artisan view:cache && \
    php artisan migrate --force && \
    apache2-foreground
