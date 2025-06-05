# Gunakan image PHP dengan Apache
FROM php:8.1-apache

# Copy semua file ke dalam container
COPY . /var/www/html/

# Install ekstensi MySQL untuk PHP
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Expose port 80 untuk akses HTTP
EXPOSE 80

# Jalankan Apache
CMD ["apache2-foreground"]
