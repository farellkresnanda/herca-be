# Gunakan PHP Apache resmi
FROM php:8.2-apache

# Install ekstensi PHP yang dibutuhkan Laravel
RUN apt-get update && apt-get install -y \
    git curl unzip zip libpng-dev libonig-dev libxml2-dev libzip-dev \
    && docker-php-ext-install pdo pdo_mysql mbstring zip exif pcntl

# Aktifkan mod_rewrite Apache (untuk Laravel route)
RUN a2enmod rewrite

# Set working directory
WORKDIR /var/www/html

# Ganti default DocumentRoot Apache ke folder public Laravel
RUN sed -i 's|/var/www/html|/var/www/html/public|g' /etc/apache2/sites-available/000-default.conf


# Copy semua file Laravel ke dalam container
COPY . .

# Beri permission storage dan bootstrap/cache
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 775 storage bootstrap/cache

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Jalankan composer install
RUN composer install --no-interaction --prefer-dist --optimize-autoloader

EXPOSE 80
