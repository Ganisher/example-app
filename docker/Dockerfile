FROM php:7.4-fpm

RUN apt-get update && apt-get install -y libmcrypt-dev git libzip-dev zip default-mysql-client
RUN docker-php-ext-configure zip && docker-php-ext-install pdo_mysql zip

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
