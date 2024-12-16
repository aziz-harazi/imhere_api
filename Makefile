DOCKER_COMPOSE = docker compose
BASH_APP = ${DOCKER_COMPOSE} exec app -it bash -c

run-app:
run-app: ${DOCKER_COMPOSE} -f compose.yml up --build
.PHONY: run-app

run-app-local:
run-app-local: ${DOCKER_COMPOSE} -f compose.local.yml --env-file .env.local up --build
.PHONY: run-app-local

exec-app:
exec-app: PHP
.PHONY: exec-app