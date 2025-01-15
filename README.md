# Software-Design--Php-Backend

> [!NOTE]
> note

## Deploy

> deploy via docker with two variants:
> 1. with `docker run`
>``` bash
> docker run --rm -p 8000:8000 -v $(pwd):/var/www/html -w /var/www/html php:latest php -S 0.0.0.> 0:9000
> ```
> 2. with `docker compose`
> ```
> docker compose up --build -d
> ```