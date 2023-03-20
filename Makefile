include .env

init:
	@$(MAKE) -s down
	@$(MAKE) -s build
	@$(MAKE) -s composer-install

build: \
	build-nginx \
	build-php-fpm \
	build-php-cli

up:
	@docker-compose up -d ${PHP_FMP_CONTAINER_NAME} ${NGINX_CONTAINER_NAME}

down:
	@docker-compose down --remove-orphans

restart: down up

build-nginx:
	@docker build -t ${REGISTRY}/${NGINX_CONTAINER_NAME}:${IMAGE_TAG} ./docker/nginx

build-php-fpm:
	@docker build -t ${REGISTRY}/${PHP_FMP_CONTAINER_NAME}:${IMAGE_TAG} ./docker/php-fpm

build-php-cli:
	@docker build -t ${REGISTRY}/${PHP_CLI_CONTAINER_NAME}:${IMAGE_TAG} ./docker/php-cli

logs:
	@docker-compose logs -f

app-php-cli-exec:
	@docker-compose run --rm ${PHP_CLI_CONTAINER_NAME} $(cmd)

composer-install:
	$(MAKE) app-php-cli-exec cmd="composer install"

chown:
	@$(MAKE) app-php-cli-exec cmd="chown 1000:1000 -R ./"