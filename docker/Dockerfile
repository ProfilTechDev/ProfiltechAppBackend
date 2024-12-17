FROM php:8.4-fpm

RUN apt-get update && apt-get install -y \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    && docker-php-ext-install \
    bcmath \
    mbstring \
    opcache \
    pdo_mysql \
    xml

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

RUN pecl install xdebug \
    && docker-php-ext-enable xdebug

COPY ./docker/xdebug.ini /usr/local/etc/php/conf.d/xdebug.ini

EXPOSE ${APP_PORT} 9000

COPY composer.json composer.lock /var/www/html/
RUN composer install --no-scripts --no-autoloader

WORKDIR /var/www/html
