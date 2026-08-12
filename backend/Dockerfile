FROM php:8.4-fpm-alpine

RUN apk add --no-cache \
    icu-dev libzip-dev oniguruma-dev linux-headers $PHPIZE_DEPS \
    && docker-php-ext-install -j$(nproc) pdo_mysql bcmath intl zip \
    && docker-php-ext-enable opcache \
    && pecl install redis \
    && docker-php-ext-enable redis \
    && apk del --no-network $PHPIZE_DEPS    

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer 

WORKDIR /var/www/html 
COPY composer.json composer.lock ./
RUN composer install --no-dev --prefer-dist --no-scripts --no-interaction

COPY . .
RUN composer dump-autoload --optimize \
    && chown -R www-data:www-data storage bootstrap/cache

EXPOSE 9000
CMD ["php-fpm"]
