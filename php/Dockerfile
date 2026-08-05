# syntax=docker/dockerfile:1.7

FROM composer:2 AS composer

FROM php:8.5-fpm-bookworm

ARG INSTALL_XDEBUG=false

ENV COMPOSER_ALLOW_SUPERUSER=1 \
    COMPOSER_MEMORY_LIMIT=-1 \
    TZ=Asia/Jakarta

RUN set -eux; \
    apt-get update; \
    apt-get install -y --no-install-recommends \
        cron \
        git \
        libcurl4-openssl-dev \
        libfreetype6-dev \
        libgmp-dev \
        libicu-dev \
        libjpeg62-turbo-dev \
        libmagickwand-dev \
        libmemcached-dev \
        libonig-dev \
        libpng-dev \
        libpq-dev \
        libsasl2-dev \
        libssl-dev \
        libxml2-dev \
        libzip-dev \
        pkg-config \
        unzip \
        zlib1g-dev; \
    docker-php-ext-configure gd --with-freetype --with-jpeg; \
    docker-php-ext-install -j"$(nproc)" \
        bcmath \
        curl \
        exif \
        gd \
        gmp \
        intl \
        mbstring \
        pcntl \
        pdo_mysql \
        pdo_pgsql \
        soap \
        sockets \
        zip; \
    pecl channel-update pecl.php.net; \
    pecl install redis mongodb imagick; \
    yes '' | pecl install memcached; \
    docker-php-ext-enable redis mongodb imagick memcached; \
    if [ "${INSTALL_XDEBUG}" = "true" ]; then \
        pecl install xdebug; \
    fi; \
    apt-get clean; \
    rm -rf /var/lib/apt/lists/* /tmp/pear

COPY --from=composer /usr/bin/composer /usr/local/bin/composer

COPY local.ini /usr/local/etc/php/conf.d/99-vinsen.ini

RUN set -eux; \
    printf '%s\n' \
        '* * * * * root cd /var/www/html && /usr/local/bin/php artisan schedule:run >> /proc/1/fd/1 2>> /proc/1/fd/2' \
        > /etc/cron.d/laravel-scheduler; \
    chmod 0644 /etc/cron.d/laravel-scheduler; \
    printf '%s\n' \
        '#!/usr/bin/env bash' \
        'exec /var/www/html/vendor/bin/dep "$@"' \
        > /usr/local/bin/dep; \
    printf '%s\n' \
        '#!/usr/bin/env bash' \
        'exec /usr/local/bin/php /var/www/html/artisan "$@"' \
        > /usr/local/bin/art; \
    printf '%s\n' \
        '#!/usr/bin/env bash' \
        'exec /usr/local/bin/php /var/www/html/artisan migrate "$@"' \
        > /usr/local/bin/migrate; \
    printf '%s\n' \
        '#!/usr/bin/env bash' \
        'exec /usr/local/bin/php /var/www/html/artisan migrate:fresh --seed "$@"' \
        > /usr/local/bin/fresh; \
    printf '%s\n' \
        '#!/usr/bin/env bash' \
        'exec /var/www/html/vendor/bin/phpunit "$@"' \
        > /usr/local/bin/t; \
    printf '%s\n' \
        '#!/usr/bin/env bash' \
        'exec /usr/local/bin/php /var/www/html/artisan dusk "$@"' \
        > /usr/local/bin/d; \
    chmod +x \
        /usr/local/bin/dep \
        /usr/local/bin/art \
        /usr/local/bin/migrate \
        /usr/local/bin/fresh \
        /usr/local/bin/t \
        /usr/local/bin/d

WORKDIR /var/www/html

COPY docker-entrypoint.sh /usr/local/bin/docker-entrypoint

RUN chmod +x /usr/local/bin/docker-entrypoint

ENTRYPOINT ["docker-entrypoint"]

EXPOSE 9000 8080

STOPSIGNAL SIGQUIT

CMD ["php-fpm"]
