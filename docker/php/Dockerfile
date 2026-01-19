FROM php:8.2-fpm-alpine

# Устанавливаем системные зависимости
RUN apk update && apk add --no-cache \
    git \
    curl \
    libpng-dev \
    libxml2-dev \
    oniguruma-dev \
    sqlite \
    sqlite-dev \
    zip \
    unzip \
    nodejs \
    npm \
    supervisor

# Устанавливаем расширения PHP
RUN docker-php-ext-install \
    pdo_mysql \
    pdo_sqlite \
    mbstring \
    exif \
    pcntl \
    bcmath \
    gd \
    opcache

# Устанавливаем Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Устанавливаем рабочий каталог
WORKDIR /var/www/html

# Копируем зависимости
COPY composer.json composer.lock ./
COPY package*.json ./

# Устанавливаем зависимости PHP (без dev-зависимостей для production)
RUN composer install --no-interaction --optimize-autoloader --no-dev

# Устанавливаем зависимости Node.js (только для production)
# RUN npm ci --only=production

# Копируем конфигурацию Supervisor
COPY docker/php/supervisor.conf /etc/supervisor/conf.d/supervisor.conf

# Настраиваем права
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 775 /var/www/html/storage \
    && chmod -R 775 /var/www/html/bootstrap/cache

# Открываем порт 9000 для PHP-FPM
EXPOSE 9000

# Запускаем PHP-FPM и Supervisor
CMD ["supervisord", "-c", "/etc/supervisor/conf.d/supervisor.conf"]