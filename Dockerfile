# Gunakan image PHP dengan ekstensi Laravel yang diperlukan
FROM php:8.2-fpm

# Install dependencies
RUN apt-get update && apt-get install -y \
    build-essential \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    curl \
    git \
    libzip-dev \
    libpq-dev \
    nano \
    && docker-php-ext-install pdo pdo_mysql mbstring exif pcntl bcmath gd zip

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set workdir
WORKDIR /var/www

# Salin semua file project Laravel ke container
COPY . .

# Install Laravel dependencies
RUN composer install

# Set permission
RUN chown -R www-data:www-data /var/www \
    && chmod -R 755 /var/www/storage

EXPOSE 9000

CMD ["php-fpm"]
