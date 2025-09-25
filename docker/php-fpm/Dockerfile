FROM php:8.3-fpm-alpine

RUN mv $PHP_INI_DIR/php.ini-development $PHP_INI_DIR/php.ini

# Устанавливаем зависимости
RUN apk add --no-cache $PHPIZE_DEPS \
    libzip-dev \
    oniguruma-dev \
    curl-dev \
    postgresql-dev \
    curl \
    unzip \
 && docker-php-ext-install pdo_pgsql pgsql zip \
 && pecl install redis \
 && docker-php-ext-enable redis \
 && apk del $PHPIZE_DEPS

# Устанавливаем Composer
RUN curl -sS https://getcomposer.org/installer | php -- \
    --install-dir=/usr/local/bin \
    --filename=composer

# Создаём пользователя (UID/GID передаём через ARG для гибкости)
ARG UID=1000
ARG GID=1000

RUN addgroup -g ${GID} app \
 && adduser -u ${UID} -G app -s /bin/sh -D app \
 && addgroup app www-data   # добавляем пользователя app в группу www-data

WORKDIR /app

# Оптимизируем права на storage и cache (Laravel специфично)
RUN mkdir -p /app/storage /app/bootstrap/cache \
 && chown -R app:www-data /app/storage /app/bootstrap/cache \
 && chmod -R 775 /app/storage /app/bootstrap/cache

USER app
