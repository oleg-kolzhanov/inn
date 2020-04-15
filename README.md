# fl.ru.test

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
* docker-compose run --rm yii-test migrate
* docker-compose run --rm codecept build

Запуск тестов:
* docker-compose run --rm codecept run