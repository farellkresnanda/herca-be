FROM php:8.2-apache

# Install dependencies
RUN apt-get update && apt-get install -y \
    git curl unzip zip libpng-dev libonig-dev libxml2-dev libzip-dev \
    && docker-php-ext-install pdo pdo_mysql mbstring zip exif

# Aktifkan mod_rewrite Laravel
RUN a2enmod rewrite

# Set working directory
WORKDIR /var/www/html

# Copy file Laravel ke dalam container
COPY . .

# Ubah hak akses
RUN chown -R www-data:www-data /var/www/html

# Copy konfigurasi Apache agar support Laravel routing
COPY ./nginx/herca-be.conf /etc/apache2/sites-available/000-default.conf
