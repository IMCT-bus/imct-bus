# IMCT-bus
## Локальное развертывание
1. ```cp .env.example .env```
2. Заполняем данные для подключения к БД (DB_)
3. ```docker-compose up -d```
  
Для базовой настройки приложения:
```
docker exec -it bus-php bash 
composer i
php artisan key:generate
php artisan migrate --seed
```
или 

``make install``

Для взаимодействия с контейнером

``docker exec -it bus-php`` или `make php_bash`

PHP - localhost:80

Vite - localhost:5173

MariaDB - localhost:3306


### Запуск сидеров
``make seed`` или ``php artisan db:seed`` в контейнере
