# syntax=docker/dockerfile:1.7
FROM node:24-alpine AS frontend
WORKDIR /build
COPY package.json ./
COPY pnpm-lock.yaml ./
RUN corepack enable \
    && pnpm install --frozen-lockfile --ignore-scripts
COPY vite.config.js ./
COPY resources ./resources
RUN pnpm run build

FROM composer:2.8 AS vendor
WORKDIR /build
COPY composer.json composer.lock ./
RUN composer install \
    --no-dev \
    --no-interaction \
    --no-progress \
    --prefer-dist \
    --optimize-autoloader \
    --classmap-authoritative \
    --no-scripts

FROM php:8.3-fpm-alpine

RUN apk add --no-cache libzip libpng icu-libs fcgi \
    && apk add --no-cache --virtual .build-deps libzip-dev libpng-dev icu-dev \
    && docker-php-ext-install -j"$(nproc)" pdo_mysql bcmath zip intl opcache \
    && apk del .build-deps \
    && mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"

WORKDIR /var/www/html

COPY --chown=www-data:www-data . .
COPY --from=vendor --chown=www-data:www-data /build/vendor ./vendor
COPY --from=frontend --chown=www-data:www-data /build/public/build ./public/build
COPY docker/php.ini "$PHP_INI_DIR/conf.d/99-production.ini"
COPY docker/www.conf /usr/local/etc/php-fpm.d/zz-app.conf

RUN mkdir -p storage/framework/cache/data storage/framework/sessions storage/framework/views storage/logs bootstrap/cache \
    && chown -R www-data:www-data storage bootstrap/cache \
    && php artisan package:discover --ansi \
    && php artisan view:cache \
    && php artisan event:cache

USER www-data

EXPOSE 9000
CMD ["sh", "-c", "php artisan config:cache && exec php-fpm -F"]
