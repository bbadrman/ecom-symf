.PHONY: start stop

start:
    docker-compose build
    docker-compose run application composer install
    docker-compose up -d

stop:
    docker-compose down