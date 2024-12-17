FROM php:8.3-fpm-alpine AS app

WORKDIR /srv

RUN apk add --no-cache postgresql-dev && \
docker-php-ext-install pgsql pdo pdo_pgsql
# Allow super user to install compose
ENV COMPOSER_ALLOW_SUPERUSER=1

COPY --from=composer:2.4 /usr/bin/composer /usr/bin/composer

COPY ./app/composer.* ./

RUN composer install --prefer-dist --no-dev --no-scripts

COPY ./app .

RUN composer dump-autoload --optimize

FROM app AS app_dev

ENV XDEBUG_MODE=off

COPY ./php/conf.d/xdebug.ini /usr/local/etc/php/conf.d/xdebug.ini

# install xdebug
RUN apk add --update linux-headers\
&& apk add --no-cache $PHPIZE_DEPS \
&& pecl install xdebug-3.4.0 \
&& docker-php-ext-enable xdebug
