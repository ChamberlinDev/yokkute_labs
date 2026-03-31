# ============================================================
# Stage 1 — Node : build des assets Vite/Tailwind
# ============================================================
FROM node:20-alpine AS node_builder

WORKDIR /app

COPY package*.json ./
RUN npm ci --prefer-offline

COPY vite.config.js ./
COPY resources/ resources/
COPY public/ public/

RUN npm run build

# ============================================================
# Stage 2 — Composer : install des dépendances PHP (prod only)
# ============================================================
FROM composer:2.8 AS composer_builder

WORKDIR /app

COPY composer.json composer.lock ./
RUN composer install \
    --no-dev \
    --no-interaction \
    --no-scripts \
    --prefer-dist \
    --optimize-autoloader

# ============================================================
# Stage 3 — Image finale PHP-FPM
# ============================================================
FROM php:8.3-fpm-alpine

# Dépendances système
RUN apk add --no-cache \
    postgresql-libs \
    libpng \
    libjpeg-turbo \
    freetype \
    icu-libs \
    oniguruma \
    zip \
    unzip \
    curl \
    bash \
    && apk add --no-cache --virtual .build-deps \
    postgresql-dev \
    libpng-dev \
    libjpeg-turbo-dev \
    freetype-dev \
    icu-dev \
    oniguruma-dev \
    $PHPIZE_DEPS \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) \
        pdo \
        pdo_pgsql \
        gd \
        intl \
        mbstring \
        opcache \
        bcmath \
        pcntl \
    && apk del .build-deps \
    && rm -rf /var/cache/apk/*

# Config PHP production
COPY docker/php/php.ini /usr/local/etc/php/conf.d/app.ini
COPY docker/php/opcache.ini /usr/local/etc/php/conf.d/opcache.ini

WORKDIR /var/www/html

# Copier le code source
COPY . .

# Copier les artefacts buildés
COPY --from=composer_builder /app/vendor ./vendor
COPY --from=node_builder /app/public/build ./public/build

# Permissions
RUN mkdir -p storage/framework/{sessions,views,cache} \
    storage/logs \
    bootstrap/cache \
    && chown -R www-data:www-data storage bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache

# Optimisations Laravel prod
RUN php artisan config:cache \
    && php artisan route:cache \
    && php artisan view:cache

EXPOSE 9000

CMD ["php-fpm"]
