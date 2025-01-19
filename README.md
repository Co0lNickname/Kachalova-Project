# Описание проекта

## Запуск

> Запуск проекта осуществляется через технологию контейнеризации Docker двумя способами:
> 1. с помощью команды `docker run`
>``` bash
> docker run --rm -p 8000:8000 -v $(pwd):/var/www/html -w /var/www/html php:latest php -S 0.0.0.> 0:9000
> ```
> 2. с помощью утилиты `docker compose`
> ```
> docker compose up --build -d
> ```

## Решение max depth error

### Проблема

```
Error response from daemon: max depth exceeded
```

Иногда встречается и следующий вариант ошибки

```
=> ERROR [php-server stage-0 6/7] RUN rm -f composer.lock && composer install --no-dev --optimize-a  0.1s 
------                                                                                                     
 > [php-server stage-0 6/7] RUN rm -f composer.lock && composer install --no-dev --optimize-autoloader:    
------
failed to solve: failed to prepare rgkbxkk5w3loohfs6f47ioqkp as jfjmvba7gjihi9mtxzg1g163h: max depth exceeded
```

Такая ошибка обычно указывает на проблему с циклическими зависимостями или слишком глубокой вложенностью в вашем проекте Docker.

### Решение

Следующая команда удаляет все скачанные образы, что позволяет очистить рекурсивные вызовы

```
docker rmi -f $(docker images -a -q)
```


