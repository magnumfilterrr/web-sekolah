# =============================
# 1. FRONTEND BUILD (Vite)
# =============================
FROM node:20 AS vite-builder
WORKDIR /app

COPY package.json package-lock.json ./
RUN npm install

COPY vite.config.js ./
COPY postcss.config.js ./
COPY tailwind.config.js ./
COPY resources ./resources
COPY public ./public

RUN npm run build

# =============================
# 2. BACKEND BUILD (Laravel + Apache)
# =============================
FROM php:8.3-apache

RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf
RUN echo "DirectoryIndex index.php index.html" >> /etc/apache2/apache2.conf

RUN printf "\n<Directory /var/www/html/public>\n\
    AllowOverride All\n\
    Require all granted\n\
</Directory>\n" >> /etc/apache2/apache2.conf

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

COPY composer.json composer.lock ./
RUN composer install --optimize-autoloader --no-dev --no-scripts \
    || composer install --optimize-autoloader --no-dev --no-scripts --ignore-platform-reqs

COPY . .
RUN rm -rf node_modules

COPY --from=vite-builder /app/public/build ./public/build

RUN composer dump-autoload --optimize

RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 storage bootstrap/cache

RUN a2enmod rewrite

ENV APACHE_DOCUMENT_ROOT=/var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' \
    /etc/apache2/sites-available/000-default.conf

EXPOSE 10000

CMD sed -i "s/80/10000/g" /etc/apache2/ports.conf && \
    php artisan config:cache && \
    php artisan route:cache && \
    php artisan view:cache && \
    php artisan migrate --force && \
    apache2-foreground
