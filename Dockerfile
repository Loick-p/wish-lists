FROM dunglas/frankenphp:1.9-php8.4

RUN install-php-extensions \
    pdo_pgsql \
    pgsql \
    redis \
    intl \
    zip \
    opcache \
    apcu \
    exif \
    gd \
    bcmath

RUN mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"

COPY --from=composer:2.8.12 /usr/bin/composer /usr/bin/composer

COPY composer.json composer.lock symfony.lock ./

RUN composer install --no-dev --optimize-autoloader --no-scripts --no-interaction

COPY . .

COPY docker/frankenphp/Caddyfile /etc/caddy/Caddyfile

RUN mkdir -p storage/logs storage/framework/sessions storage/framework/views storage/framework/cache bootstrap/cache \
    && chown -R www-data:www-data storage bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache

RUN php artisan optimize

EXPOSE 80 443

CMD ["frankenphp", "run", "--config", "/etc/caddy/Caddyfile"]
