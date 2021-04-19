FROM php:7.4-fpm-alpine

RUN chgrp -R www-data /var/www/html/storage /var/www/html/bootstrap/cache

RUN chmod -R ug+rwx /var/www/html/storage /var/www/html/bootstrap/cache

RUN docker-php-ext-install pdo pdo_mysql
