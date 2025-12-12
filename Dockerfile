# ------------------------------------------------------------
# STAGE 1: Composer (pakai PHP 8.3 CLI + ekstensi lengkap)
# ------------------------------------------------------------
FROM php:8.3-cli AS composer_stage

RUN apt-get update && apt-get install -y \
    git curl zip unzip libpng-dev libzip-dev libonig-dev \
    libxml2-dev libicu-dev libpq-dev \
 && docker-php-ext-install intl mbstring pcntl bcmath zip

WORKDIR /app

COPY composer.json composer.lock ./

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN composer install \
    --no-dev \
    --no-scripts \
    --no-progress \
    --optimize-autoloader

# ------------------------------------------------------------
# STAGE 2: Node (Vite Build)
# ------------------------------------------------------------
FROM node:20 AS node_stage

WORKDIR /app

COPY package.json package-lock.json ./
RUN npm install

COPY . .
RUN npm run build

# ------------------------------------------------------------
# STAGE 3: Final Laravel + PHP 8.3 + Apache
# ------------------------------------------------------------
FROM php:8.3-apache AS production

RUN apt-get update && apt-get install -y \
    git curl zip unzip libpng-dev libzip-dev libonig-dev \
    libxml2-dev libicu-dev libpq-dev \
 && docker-php-ext-install pdo pdo_pgsql pgsql \
    mbstring exif pcntl bcmath gd zip intl \
 && a2enmod rewrite

ENV APACHE_DOCUMENT_ROOT=/var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf \
 && sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

WORKDIR /var/www/html

COPY . .

# Copy vendor hasil composer stage
COPY --from=composer_stage /app/vendor ./vendor

# Copy asset Vite build
COPY --from=node_stage /app/public/build ./public/build

RUN chown -R www-data:www-data /var/www/html \
 && chmod -R 755 storage bootstrap/cache

RUN php artisan config:cache && \
    php artisan route:cache && \
    php artisan view:cache

EXPOSE 10000

CMD sed -i "s/80/10000/g" /etc/apache2/sites-available/000-default.conf /etc/apache2/ports.conf \
 && php artisan migrate --force \
 && apache2-foreground
