# Stage 1: Build composer dependencies
FROM composer:2.6 as vendor

WORKDIR /app
COPY database/ database/
COPY composer.json composer.lock ./
RUN composer install \
    --ignore-platform-reqs \
    --no-interaction \
    --no-plugins \
    --no-scripts \
    --prefer-dist

# Stage 2: Build the application
FROM php:8.2-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonib-dev \
    libxml2-dev \
    zip \
    unzip

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Install Node.js
RUN curl -sL https://deb.nodesource.com/setup_16.x | bash -
RUN apt-get install -y nodejs

# Copy composer.lock and composer.json
COPY composer.lock composer.json /var/www/

# Set working directory
WORKDIR /var/www

# Copy existing application directory contents
COPY . /var/www

# Copy vendor directory from vendor stage
COPY --from=vendor /app/vendor/ /var/www/vendor/

# Create .env file if not exists and set permissions
RUN if [ ! -f .env ]; then \
        cp .env.example .env && \
        sed -i 's/APP_KEY=/APP_KEY=base64:tempkeyreplaceinproduction/' .env; \
    fi

# Set proper permissions
RUN chmod -R 777 storage bootstrap/cache

# Expose port 9000 for PHP-FPM
EXPOSE 9000

# Start PHP-FPM
CMD ["php-fpm"]