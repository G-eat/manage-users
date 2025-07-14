FROM php:8.2-cli

# Install system dependencies + mysql client + PHP extensions
RUN apt-get update && apt-get install -y \
    git unzip zip libzip-dev libpng-dev libonig-dev libxml2-dev libcurl4-openssl-dev curl default-mysql-client \
    && docker-php-ext-install pdo pdo_mysql zip mbstring exif pcntl bcmath gd curl xml \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Install Composer globally
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# Copy composer files and install dependencies (cached layer)
COPY composer.json composer.lock ./

RUN composer install --no-interaction --prefer-dist --optimize-autoloader

# Copy app source code
COPY . .

# Expose port 8000 for Laravel's built-in server
EXPOSE 8000

# Wait for MySQL before migrating and running server
CMD sh -c "echo 'Waiting for MySQL to be available...'; until mysql -h mysql -u root -psecret_password -e 'select 1' > /dev/null 2>&1; do echo 'Waiting for MySQL...'; sleep 3; done; echo 'MySQL is up, running migrations'; php artisan migrate --force; echo 'Starting Laravel server'; php artisan serve --host=0.0.0.0 --port=8000"

