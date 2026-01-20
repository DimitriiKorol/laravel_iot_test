FROM php:8.4-fpm-alpine

WORKDIR /var/www/html

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
    npm

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

#copy all project files
COPY composer.json ./
COPY composer.lock ./
COPY package*.json ./
COPY . .

RUN git config --global --add safe.directory /var/www/html

#Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
    && composer --version

RUN composer install
# Устанавливаем зависимости Node.js (только для production)
# RUN npm ci --only=production

# Настраиваем права
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 775 /var/www/html/storage \
    && chmod -R 775 /var/www/html/bootstrap/cache

# Открываем порт 9000 для PHP-FPM
EXPOSE 9000
