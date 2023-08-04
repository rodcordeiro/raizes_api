FROM php:7.4-apache

WORKDIR /var/www/html

RUN apt-get update -y && apt-get upgrade -y

# PHP extensions

RUN docker-php-ext-install pdo pdo_mysql
