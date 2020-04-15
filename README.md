# fl.ru.test

## Прокси

Поднять контейнер прокси

[jwilder/nginx-proxy:alpine](https://hub.docker.com/r/jwilder/nginx-proxy/)

Создать сеть proxy

* `docker network create -d bridge proxy`

Прописать в hosts: 

```
127.0.0.1       fl.ru.test
127.0.0.1       backend.fl.ru.test
127.0.0.1       pgadmin.fl.ru.test
127.0.0.1       hub.fl.ru.test
```


## Поднятие проекта

* `cp .env-sample .env`
* `docker-compose build`
* `docker-compose run --rm php php init`
* `docker-compose run --rm composer install`
* `docker-compose run --rm yii migrate` 
* `docker-compose run --rm yii migrate --migrationPath=@yii/rbac/migrations/` 
* `docker-compose run --rm yii rbac/init` 
* `docker-compose up -d`

Когда проект собрался, открываем ссылку в браузере [http://fl.ru.test](http://fl.ru.test)

## Тесты

Настройка тестов:
* `docker-compose run --rm yii-test migrate`
* `docker-compose run --rm codecept build`

Запуск всех тестов:
* `docker-compose run --rm codecept run`

Запуск юнит-тестов:
* `docker-compose run --rm codecept run unit -c frontend`

Запуск приемочных тестов:
* `docker-compose run --rm codecept run acceptance -c frontend`

Запуск одного теста:
* `docker-compose run --rm codecept run acceptance HomeCest:checkHome -c frontend`