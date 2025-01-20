FROM php:latest

RUN apt-get update && apt-get install -y \
    git \
    unzip \
    zip \
    libmariadb-dev \
    && rm -rf /var/lib/apt/lists/*

RUN apt-get update && docker-php-ext-install pdo_mysql

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /var/www/html

COPY . .

RUN composer install --no-dev --optimize-autoloader --ignore-platform-req=ext-gd

CMD ["php-fpm"]