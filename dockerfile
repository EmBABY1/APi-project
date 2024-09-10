FROM php:7.4-fpm
RUN apt-get update && apt-get install -y libzip-dev unzip
RUN docker-php-ext-install pdo pdo_mysql zip
WORKDIR /var/www/html
COPY . .
RUN composer install
