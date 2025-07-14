FROM php:8.2-cli

# Install system dependencies and PHP extensions
RUN apt-get update && apt-get install -y \
    git unzip zip libzip-dev libpng-dev libonig-dev libxml2-dev libcurl4-openssl-dev curl default-mysql-client \
    && docker-php-ext-install pdo pdo_mysql zip mbstring exif pcntl bcmath gd curl xml \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Install Composer globally from Composer image
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set the working directory
WORKDIR /var/www/html

# Copy full Laravel project (including artisan) BEFORE running composer
COPY . .

# Install PHP dependencies
RUN composer install --no-interaction --prefer-dist --optimize-autoloader

# Expose Laravel dev server port
EXPOSE 8000

# Start the server after waiting for MySQL to be ready
CMD sh -c "echo 'Waiting for MySQL...'; \
    until mysql -h mysql -u root -psecret_password -e 'SELECT 1' > /dev/null 2>&1; do \
        echo 'Waiting for MySQL...'; sleep 3; \
    done; \
    echo 'MySQL is up! Running migrations...'; \
    php artisan migrate --force; \
    echo 'Starting Laravel server...'; \
    php artisan serve --host=0.0.0.0 --port=8000"
