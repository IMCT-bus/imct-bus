PHP_CONTAINER = bus-php
EXEC = docker exec -it $(PHP_CONTAINER)

install:
	$(EXEC) composer i
	$(EXEC) php artisan key:generate
	$(EXEC) php artisan migrate
	make prod_seed

migrate:
	$(EXEC) php artisan migrate

prod_seed:
	$(EXEC) php artisan db:seed --class=UserSeeder

dev_seed:
	$(EXEC) php artisan db:seed

wipe:
	$(EXEC) php artisan db:wipe

route_cache:
	$(EXEC) php artisan route:cache

config_cache:
	$(EXEC) php artisan config:cache

test:
	$(EXEC) php artisan migrate --env=testing
	$(EXEC) php artisan test

php_bash:
	$(EXEC) bash

refresh:
	$(EXEC) php artisan db:wipe
	$(EXEC) php artisan migrate
	make dev_seed
