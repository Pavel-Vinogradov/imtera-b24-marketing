FROM php:8.3-fpm

# Установка переменных окружения
ENV COMPOSER_ALLOW_SUPERUSER=1

# Установим необходимые зависимости
RUN apt-get update && apt-get install -y \
    vim \
    git \
    postgresql-server-dev-15 \
    libzip-dev zip unzip \
    libpng-dev libfreetype-dev \
    tzdata \
    curl \
    libonig-dev

# Установка расширений PHP
RUN docker-php-ext-install pdo \
    && docker-php-ext-install pdo_pgsql \
    && docker-php-ext-configure zip \
    && docker-php-ext-install zip \
    && docker-php-ext-configure gd --with-freetype \
    && docker-php-ext-install gd \
    && docker-php-ext-install intl \
    && docker-php-ext-install bcmath \
    && docker-php-ext-install pcntl



# Установка Redis
RUN pecl install --force redis \
    && rm -rf /tmp/pear \
    && docker-php-ext-enable redis

# Установка Xdebug
RUN pecl install xdebug \
    && docker-php-ext-enable xdebug

# Настройка PHP
RUN touch /usr/local/etc/php/php.ini \
    && echo "upload_max_filesize = 1024M" >> /usr/local/etc/php/php.ini  \
    && echo "post_max_size = 1030M" >> /usr/local/etc/php/php.ini  \
    && echo "date.timezone=Europe/Moscow" >> /usr/local/etc/php/php.ini \
    && echo "memory_limit = 512M" >> /usr/local/etc/php/php.ini

# Установка Composer
COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

# Создаём директорию приложения
WORKDIR /var/www/app

# Копируем файлы приложения
COPY . /var/www/app

# Настраиваем права доступа
RUN chown -R www-data:www-data /var/www/app \
    && chmod -R 755 /var/www/app

RUN composer install --no-scripts --optimize-autoloader

# Команда для запуска PHP-FPM
CMD ["php-fpm"]
