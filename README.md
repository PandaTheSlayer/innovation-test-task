If you want to override default ports:
```
$ cp .env.dist .env
```

To run project:
```
$ make dcup                                           # docker-compose up -d
$ make apiup                                          # docker-compose exec bash bin/build
$ make clientup                                       # docker-compose exec client bash composer install
$ make client-run [minutes] [threshold, default=0.5s] # docker-compose exec client php bin/test [minutes] [threshold, default=0.5s]
```
