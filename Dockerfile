FROM php:7.4-apache

RUN docker-php-ext-install pdo pdo_mysql

COPY src /var/www/html

WORKDIR /var/www/html

RUN chown www-data:www-data -R *



EXPOSE 80/tcp
EXPOSE 443/tcp

