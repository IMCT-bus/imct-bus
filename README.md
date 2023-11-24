# IMCT-bus

## Локальное развертывание
Требуется docker + make (опционально)
```
cp .env.example .env
```
В .env заполняем данные для подключения к БД (DB_), реквизиты для входа в админский аккаунт (ADMIN_)

```
docker-compose up -d
```
  
Для базовой настройки приложения:
```
docker exec -it bus-php bash 
composer i
php artisan key:generate
php artisan migrate
php artisan db:seed --class=UserSeeder
```
или 

```
make install
```

Для взаимодействия с контейнером

```
docker exec -it bus-php
```
или 
```
make php_bash
```

PHP - localhost:80

Vite - localhost:5173

MariaDB - localhost:3306


### Запуск всех сидеров
в контейнере
```
php artisan db:seed
```
или 
```
make dev_seed
```
