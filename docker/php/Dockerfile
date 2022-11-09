FROM php:8.1-fpm

RUN  apt-get update && apt-get install --no-install-recommends -y libpq-dev zlib1g-dev g++ git libicu-dev zip libzip-dev \
   && docker-php-ext-install pdo pgsql pdo_pgsql zip

WORKDIR /var/www/symfony_docker

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN addgroup --system --gid 1000 application
RUN adduser --uid 1000 --system --gid 1000 application
USER application


