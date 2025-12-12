# =============================
# 1. FRONTEND BUILD (Vite)
# =============================
FROM node:20 AS vite-builder

WORKDIR /app

# Copy package files
COPY package.json package-lock.json ./

# Install node dependencies
RUN npm install

# Copy required frontend files
COPY vite.config.js ./
COPY postcss.config.js ./
COPY tailwind.config.js ./

COPY resources ./resources
COPY public ./public

# Build frontend assets
RUN npm run build
FROM php:8.3-apache

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git curl unzip zip \
    libpng-dev libonig-dev libxml2-dev \
    libzip-dev libicu-dev libpq-dev && \
    apt-get clean && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install \
    pdo_pgsql pgsql mbstring exif pcntl \
    bcmath gd zip intl

# Copy Composer binary
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html

# Copy only composer files first
COPY composer.json composer.lock ./

# Install backend dependencies
RUN composer install --optimize-autoloader --no-dev --no-scripts || \
    composer install --optimize-autoloader --no-dev --no-scripts --ignore-platform-reqs

# Copy application source
COPY . .

# Remove local node_modules accidentally copied
RUN rm -rf node_modules

# Copy Vite build output
COPY --from=vite-builder /app/public/build ./public/build

# Regenerate optimized autoload
RUN composer dump-autoload --optimize

# Set proper permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 storage bootstrap/cache

# Enable Apache Rewrite
RUN a2enmod rewrite

# Configure DocumentRoot
ENV APACHE_DOCUMENT_ROOT=/var/www/html/public

RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' \
    /etc/apache2/sites-available/000-default.conf

RUN sed -ri -e 's!Directory /var/www/!Directory ${APACHE_DOCUMENT_ROOT}!g' \
    /etc/apache2/apache2.conf

# Expose port (Render)
EXPOSE 10000

CMD sed -i "s/80/10000/g" /etc/apache2/ports.conf && \
    php artisan config:cache && \
    php artisan route:cache && \
    php artisan view:cache && \
    php artisan migrate --force && \
    apache2-foreground
