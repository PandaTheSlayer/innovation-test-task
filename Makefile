dcup:
	docker-compose up -d

dcbash:
	docker-compose exec fpm bash

projup:
	docker-compose exec fpm bash bin/build
