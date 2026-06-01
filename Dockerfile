FROM php:8.2-apache

# =========================
# System dependencies
# =========================
RUN apt-get update && apt-get install -y \
    git \
    curl \
    unzip \
    zip \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libpq-dev

# =========================
# Apache setup
# =========================
RUN a2enmod rewrite

ENV APACHE_DOCUMENT_ROOT=/var/www/html/public

RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' \
    /etc/apache2/sites-available/*.conf

RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' \
    /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# =========================
# PHP extensions
# =========================
RUN docker-php-ext-install pdo pdo_pgsql

# =========================
# Composer
# =========================
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# =========================
# App setup
# =========================
WORKDIR /var/www/html

COPY . .

# Install dependencies
RUN composer install --no-dev --optimize-autoloader

# =========================
# Laravel permissions
# =========================
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 775 storage bootstrap/cache

# =========================
# IMPORTANT: clear caches
# =========================
RUN php artisan optimize:clear || true

# =========================
# Port (Render uses 80 internally)
# =========================
EXPOSE 80

CMD ["apache2-foreground"]