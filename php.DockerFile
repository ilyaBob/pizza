FROM php:8.3-fpm-alpine

RUN docker-php-ext-install pdo pdo_mysql
RUN apk add --no-cache curl git \
    && docker-php-ext-install pdo pdo_mysql \
    && curl -sS https://getcomposer.org/installer | php -- \
        --install-dir=/usr/local/bin \
        --filename=composer \
    && chmod +x /usr/local/bin/composer

WORKDIR /var/www/laravel

