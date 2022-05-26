FROM php:8.1-fpm

USER root

RUN mkdir -p /var/www/web

WORKDIR /var/www/web

RUN apt-get update && apt-get install -y \
        build-essential libfreetype6-dev libicu-dev g++ \
        libpng-dev libjpeg-dev zlib1g-dev libxml2-dev libzip-dev \
        libonig-dev libssl-dev libmcrypt-dev \
        zip unzip curl locales git curl \
        jpegoptim optipng pngquant gifsicle \
    && apt-get autoremove -y \
    && apt-get autoclean -y

# Install extensions
RUN docker-php-ext-install pdo_mysql mbstring zip exif pcntl bcmath \
    && docker-php-ext-configure gd \
    && docker-php-ext-install gd

RUN pecl install redis && docker-php-ext-enable redis

RUN chgrp -R www-data /var/www/web
