DOCKER_COMPOSE = docker compose
BASH_APP = ${DOCKER_COMPOSE} exec app ash -c
BASH_DB = ${DOCKER_COMPOSE} exec -i db psql -U user sf_project_1 -c

run-app:
run-app: ${DOCKER_COMPOSE} -f compose.yml up --build
.PHONY: run-app

run-app-local:
run-app-local: ${DOCKER_COMPOSE} -f compose.local.yml --env-file .env.local up --build
.PHONY: run-app-local

exec-app:
exec-app: PHP
.PHONY: exec-app

# password test1234
create-users:
create-users:
	${BASH_DB} "insert into users (id, email, password) values ('07a2f327-103a-11e9-8025-00ff5d11a779', 'test@email.com','$2y$13$QxH5inyYt4bKvbGNkzwKjO3x7J0nC3dyxZ1NU9rPjH.6CGQGELlSC')"
.PHONY: create-users