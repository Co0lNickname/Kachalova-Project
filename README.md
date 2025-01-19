# Описание проекта

## Запуск

Запуск проекта осуществляется через технологию контейнеризации Docker двумя способами:
1. с помощью команды `docker run`
``` bash
 docker run --rm -p 8000:8000 -v $(pwd):/var/www/html -w /var/www/html php:latest php -S 0.0.0.> 0:9000
```
2. с помощью утилиты `docker compose`
```
docker compose up --build -d
```

## Работа с контейнерами

### Контейнер базы данных

Для входа в контейнер базы данных, который называется `mysql` с использованием `bash` используется следующая команда
```
docker exec -it mysql bash
```

Чтобы воспользоваться самой субд `mysql` есть два варианта:
1. либо уже находясь в контейнере, используя `bash`
``` bash
mysql -uadmin -padminpassword
```
2. либо извне контейнера
```
docker exec -it mysql mysql -uadmin -padminpassword
```

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


