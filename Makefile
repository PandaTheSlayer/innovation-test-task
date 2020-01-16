dcup:
	docker-compose up -d

dcbash:
	docker-compose exec fpm bash

apiup:
	docker-compose exec fpm bash bin/build

clientup:
	docker-compose exec client bash composer install

test:
	docker-compose exec client php bin/test
