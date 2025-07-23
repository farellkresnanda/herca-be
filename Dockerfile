# Stage 1: Build
FROM composer:2 as builder

WORKDIR /app
COPY . .
RUN composer install --no-dev --optimize-autoloader

# Stage 2: Runtime
FROM php:8.2-fpm-alpine

WORKDIR /var/www/html

# Install dependencies
RUN apk add --no-cache \
    nginx \
    supervisor \
    libzip-dev \
    zip \
    unzip \
    mysql-client

# Install PHP extensions
RUN docker-php-ext-install pdo pdo_mysql zip

# Copy built files from builder
COPY --from=builder /app /var/www/html
COPY . /var/www/html

# Copy configuration files
COPY docker/nginx.conf /etc/nginx/nginx.conf
COPY docker/supervisord.conf /etc/supervisor/conf.d/supervisord.conf

# Set permissions
RUN chown -R www-data:www-data /var/www/html/storage
RUN chown -R www-data:www-data /var/www/html/bootstrap/cache

# Expose port
EXPOSE 9000

CMD ["/usr/bin/supervisord", "-c", "/etc/supervisor/conf.d/supervisord.conf"]