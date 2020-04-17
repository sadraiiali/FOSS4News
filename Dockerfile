FROM php:7.4-apache
 
COPY src /var/www/html
WORKDIR /var/www/html

RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd&& \
    a2enmod rewrite && \
    cp apache/* /etc/apache2/sites-available && \
    a2ensite foss4news.conf && \
    a2dissite 000-default.conf && \
    chmod -R 775 public && \
    service apache2 restart

EXPOSE 80/tcp
EXPOSE 443/tcp
