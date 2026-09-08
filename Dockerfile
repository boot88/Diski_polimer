# =========================================================
#  Dockerfile — Diski_polimer (Laravel 12) для Render
#  Ветка деплоя: codex/audit-and-hardening
# =========================================================
FROM php:8.5-apache

# ---- системные пакеты + PHP-расширения -------------------
ENV DEBIAN_FRONTEND=noninteractive
RUN apt-get update \
    && apt-get install -y --no-install-recommends \
        git unzip \
        libzip-dev libicu-dev libonig-dev \
        libcurl4-openssl-dev libssl-dev \
    && docker-php-ext-install -j"$(nproc)" \
        pdo pdo_sqlite mbstring intl zip opcache \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# ---- apache: корень на public, модули --------------------
ENV APACHE_DOCUMENT_ROOT=/var/www/html/public
RUN a2enmod rewrite headers \
    && sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' \
        /etc/apache2/sites-available/*.conf /etc/apache2/apache2.conf \
    && sed -ri 's/AllowOverride None/AllowOverride All/g' \
        /etc/apache2/apache2.conf /etc/apache2/sites-available/*.conf

# ---- копируем проект -------------------------------------
WORKDIR /var/www/html
COPY . .

# ---- права на служебные каталоги (до composer-скриптов) ---
RUN mkdir -p storage/framework/{sessions,views,cache} storage/logs bootstrap/cache \
    && chown -R www-data:www-data storage bootstrap/cache public \
    && chmod -R ug+rwX storage bootstrap/cache

# ---- composer (зависимости из composer.lock) --------------
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer
ENV COMPOSER_ALLOW_SUPERUSER=1
RUN composer install --no-dev --no-interaction --no-progress --optimize-autoloader

EXPOSE 80
CMD ["apache2-foreground"]
