FROM php:8.0-apache
RUN a2enmod rewrite

RUN apt update \
    && apt install -y \
    g++ \
    libicu-dev \
    libpq-dev \
    libzip-dev \
    zip \
    zlib1g-dev \
    && docker-php-ext-install \
    intl \
    opcache \
    pdo \
    mysqli \
    pdo_mysql

WORKDIR /var/www/html
RUN chmod -R 775 /var/www/html
RUN chown -R $USER:www-data /var/www/html
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

EXPOSE 80
EXPOSE 443

