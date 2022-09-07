ARG PHP_VERSION=7.2
FROM php:${PHP_VERSION}-cli

RUN pecl install pcov && docker-php-ext-enable pcov

# Install composer to manage PHP dependencies
RUN apt-get update && apt-get install -y git zip
RUN curl https://getcomposer.org/download/2.2.6/composer.phar -o /usr/local/sbin/composer
RUN chmod +x /usr/local/sbin/composer
RUN echo "if [[ $PHP_VERSION == 7.* ]]; then composer self-update --1; else composer self-update; fi" > composer.sh
RUN bash composer.sh

WORKDIR /app
