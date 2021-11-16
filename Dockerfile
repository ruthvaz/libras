FROM php:7.3-rc-apache

RUN apt-get update && apt-get install -y \
    && docker-php-ext-install pdo_mysql \
    && apt-get clean \
    # && chmod -R 755 /var/www/html/ \