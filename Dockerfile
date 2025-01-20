FROM php:latest

RUN apt-get update && apt-get install -y \
    git \
    unzip \
    zip \
    libmariadb-dev \
    && rm -rf /var/lib/apt/lists/*

RUN apt-get update && docker-php-ext-install pdo_mysql

WORKDIR /var/www/html

COPY . .

CMD ["php-fpm"]