# =============================
# 1. FRONTEND BUILD (Vite)
# =============================
FROM node:20 AS vite-builder

WORKDIR /app

# Copy package files
COPY package.json package-lock.json ./

# Install node dependencies
RUN npm install

# Copy ALL required frontend config
COPY vite.config.js ./
COPY postcss.config.js ./
COPY tailwind.config.js ./

# Copy Laravel sources (yang dibutuhkan oleh Vite)
COPY resources ./resources
COPY public ./public

# Build frontend (Vite)
RUN npm run build


# =============================
# 2. BACKEND BUILD (Laravel + Apache)
# =============================
FROM php:8.3-apache

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    libicu-dev \
    zip \
    unzip \
    libpq-dev

RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install \
    pdo_pgsql \
    pgsql \
    mbstring \
    exif \
    pcntl \
    bcmath \
    gd \
    zip \
    intl

# Copy Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# Copy composer files
COPY composer.json composer.lock ./

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader --no-scripts || \
    composer install --no-dev --optimize-autoloader --no-scripts --ignore-platform-reqs

# Copy the full backend application
COPY . /var/www/html

# Copy Vite build output
COPY --from=vite-builder /app/public/build ./public/build

# Optimize autoload
RUN composer dump-autoload --optimize

# Fix permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html/storage \
    && chmod -R 755 /var/www/html/bootstrap/cache

# Enable mod_rewrite
RUN a2enmod rewrite

# Set Apache DocumentRoot
ENV APACHE_DOCUMENT_ROOT=/var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

EXPOSE 10000

CMD sed -i "s/80/10000/g" /etc/apache2/sites-available/000-default.conf /etc/apache2/ports.conf && \
    php artisan config:cache && \
    php artisan route:cache && \
    php artisan view:cache && \
    php artisan migrate --force && \
    apache2-foreground
