FROM php:8.4-apache

# 1. Установка системных зависимостей
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libzip-dev \
    libicu-dev \
    unzip \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd zip intl opcache

# 2. Включаем mod_rewrite
RUN a2enmod rewrite

# 4. Установка Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# 5. Устанавливаем рабочую директорию
WORKDIR /var/www/html

# 6. Копируем только файлы зависимостей
COPY composer.json composer.lock ./

# 6. Устанавливаем зависимости
RUN composer install --no-interaction --no-dev --optimize-autoloader --no-scripts

# 7. Копируем всё остальное содержимое проекта
COPY . .
