To run project:
```
$ make dcup                                     # docker-compose up -d
$ make projup                                   # docker-compose exec bash bin/build
$ make test [minutes] [threshold, default=0.5s] # docker-compose exec fpm php bin/test [minutes] [threshold, default=0.5s]
```
