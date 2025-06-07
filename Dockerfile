# Use official PHP image with Apache
FROM php:8.2-apache

# Enable Apache mod_rewrite (needed for Laravel routing)
RUN a2enmod rewrite

# Install PHP extensions Laravel needs
RUN docker-php-ext-install pdo pdo_mysql mbstring tokenizer xml ctype json

# Install Composer (dependency manager)
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory inside the container
WORKDIR /var/www/html

# Copy everything into the container
COPY . .

# Install Laravel dependencies
RUN composer install --no-dev --optimize-autoloader

# Set permissions for Laravel storage and cache folders (important!)
RUN chown -R www-data:www-data storage bootstrap/cache

# Set Apache document root to Laravel's public folder
RUN sed -i 's!/var/www/html!/var/www/html/public!g' /etc/apache2/sites-available/000-default.conf

# Expose port 80 for HTTP
EXPOSE 80

# Start Apache in the foreground (required for Docker container to keep running)
CMD ["apache2-foreground"]
