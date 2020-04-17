FROM php:7.4-fpm

RUN docker-php-ext-install pdo_mysql \
    && docker-php-ext-install json

#Postgres Driver
RUN apt-get update && apt-get install -y \
    libpq-dev \
    libpng-dev \
    zip unzip \
    git \
    iputils-ping && \
    docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql && \
    docker-php-ext-install pdo pdo_pgsql pgsql && \
    docker-php-ext-install gd

#Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
