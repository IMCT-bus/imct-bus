# IMCT-bus

## Локальное развертывание
Требуется docker + make (опционально)
```
cp .env.example .env
```
В .env заполняем данные для подключения к БД (DB_)

```
docker-compose up -d
```
  
Для базовой настройки приложения:
```
docker exec -it bus-php bash 
composer i
php artisan key:generate
php artisan migrate --seed
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


### Запуск сидеров
```
make seed
```
или 
```
php artisan db:seed
```
в контейнере
