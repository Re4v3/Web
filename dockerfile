# Use an official PHP runtime as a parent image
FROM php:7.4-apache

# Set the working directory in the container
WORKDIR /var/www/html

# Copy the current directory contents into the container at /var/www/html
COPY . /var/www/html

# Install PostgreSQL extension for PHP
RUN docker-php-ext-install pdo pdo_pgsql

# Apache configuration (optional): Enable mod_rewrite for pretty URLs
RUN a2enmod rewrite

# Expose port 80 to allow incoming connections to the web server
EXPOSE 80

# Start Apache server
CMD ["apache2-foreground"]
