FROM php:8.4-cli

# Install system dependencies and PHP extensions needed for Laravel
RUN apt-get update && apt-get install -y \
    git unzip zip libzip-dev libpng-dev libonig-dev libxml2-dev libcurl4-openssl-dev curl \
    && docker-php-ext-install pdo pdo_mysql zip mbstring exif pcntl bcmath gd curl xml

# Install Composer globally
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# Copy composer files and install dependencies first for caching
COPY composer.json composer.lock ./

RUN composer install --no-interaction --prefer-dist --optimize-autoloader

# Copy app source code
COPY . .

# Generate application key
RUN php artisan key:generate

# Expose port for Laravel built-in server
EXPOSE 8000

# Run commands: composer install, migrate, then serve Laravel app
CMD sh -c "composer install && php artisan migrate --force && php artisan serve --host=0.0.0.0 --port=8000"
