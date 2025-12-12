# ============================
# Stage 1 – Build Frontend (Vite)
# ============================
FROM node:18 AS vite-builder

WORKDIR /app

COPY package.json package-lock.json ./
RUN npm install

COPY . .
RUN npm run build


# ============================
# Stage 2 – PHP + Apache
# ============================
FROM php:8.3-apache

RUN apt-get update && apt-get install -y \
    git curl zip unzip libpng-dev libonig-dev libxml2-dev \
    libzip-dev libicu-dev libpq-dev && \
    docker-php-ext-install pdo_pgsql pgsql mbstring exif pcntl bcmath gd zip intl

# Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

COPY composer.json composer.lock ./
RUN composer install --no-dev --optimize-autoloader

COPY . .

# >>> COPY HASIL BUILD VITE <<<
COPY --from=vite-builder /app/public/build ./public/build

RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 storage \
    && chmod -R 755 bootstrap/cache

RUN a2enmod rewrite

ENV APACHE_DOCUMENT_ROOT=/var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf

EXPOSE 10000

CMD sed -i "s/80/10000/g" /etc/apache2/sites-available/000-default.conf /etc/apache2/ports.conf && \
    php artisan config:cache && \
    php artisan route:cache && \
    php artisan view:cache && \
    apache2-foreground
