SHELL := /bin/bash

#alias m='make'

all: build up

build:
	docker compose build

up:
	docker compose up -d

down:
	docker compose down

stop:
	docker compose stop

restart:
	docker compose restart

clean: down
	docker system prune -af
	docker volume prune -f

rebuild: clean build

status:
	docker compose ps

ps:
	docker ps
psa:
	docker compose ps -a

comps:
	docker compose ps -a

p:
	docker exec -it learning-laravel.test-1 bash

mysql:
	docker exec -it mysql mysql -uroot -ppassword

.PHONY: perm
f ?= AT_BaseMultipleApps
perm:
	sudo chmod -R 777 ../$(f)/

.PHONY: perma
f ?= AT_BaseMultipleApps
perma:
	sudo chmod -R 777 ./$(f)/

zone:
	find ../$(PROJECT_NAME) -name '*Zone.Identifier*' -exec rm {} +

net:
	docker network ls

stat:
	docker stats
