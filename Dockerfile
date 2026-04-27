FROM php:8.2-apache

RUN apt-get update && apt-get install -y \
    libpng-dev libjpeg-dev libfreetype6-dev \
    libzip-dev libicu-dev libonig-dev \
    unzip curl git \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install \
        gd pdo pdo_mysql mysqli \
        zip intl mbstring opcache exif

RUN a2enmod rewrite

COPY config/apache.conf /etc/apache2/sites-available/000-default.conf