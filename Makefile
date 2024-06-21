# GLOBAL
help:
	echo " ---- --- -- Hey , dspoken Makefile !!!!! \n \n" \
	"List of make commands : \n" \
	"> composer-install \n" \
	"> composer-update \n" \
	"> cc            : Default clear cache \n" \
	"> cc-dev        : clear cache in dev env\n" \
	"> cc-prod       : clear cache in prod env \n" \
	"> cc-f          : clear cache by removing files physically \n" \
	"> upload-access : Set chmod 755 to assets/images/uploads \n" \
	"> start  : docker start\n" \
	"> stop   : docker stop\n" \
	"> npm-install   : Install npm \n" \
	"> npm-repair    : Run npm audit fix to fix some vulnerabilities \n" \
	"> npm-update    : update npm modules \n" \
	"> encore-dev    : Run webpack encore in development mode \n" \
	"> encore-watch  : Run webpack encore in development+watch mode  \n" \
	"> encore-prod   : Run webpack encore in production mode  \n" \
	"> assets-dev    : Run assets-install fos-routes-dump + npm-install + encore-dev  \n" \
	"> assets-prod   : Run assets-install fos-routes-dump + npm-install + encore-prod  \n" \
	"> assets-watch  : Run + symfony assets install + fos-dump + webpack encore dev on watch mode  \n" \
	"> php-sh        : Connect to php container inner terminal\n" \
	"> ssh-php        : Connect to php container inner terminal\n" \
# GLOBAL
# USAGE
init: composer-install cc db-update assets-all
# USAGE
# DOCKER
start:
	docker compose up -d
start-build:
	docker compose up -d --build
stop:
	docker compose stop
restart: stop start
build:
	docker compose build
build-no-cache:
	docker compose build --no-cache
php-sh:
	docker compose exec php sh
	
ssh-php:
	docker compose exec php bash
# DOCKER
# PHP APP
## COMPOSER
composer-install:
	echo "Install composer dependences ...\n";
	docker compose exec php composer install
composer-update:
	echo "Update composer dependences ...\n";
	docker compose exec php composer update
## SYMFONY
cc:
	docker compose exec php bin/console cache:clear
cc-dev:
	docker compose exec php bin/console cache:clear --env=dev
cc-prod:
	docker compose exec php bin/console cache:clear --env=prod
cc-f:
	docker compose exec php rm -rf var/cache/*
## UPLOADS
upload-access:
	docker compose exec php mkdir -p assets/images/uploads
	docker compose exec php chmod 777 -R assets/images/uploads
## TESTS
test-all:
	docker compose exec php ./vendor/bin/codecept run
test-unit:
	docker compose exec php ./vendor/bin/codecept run unit
test-functional:
	docker compose exec php ./vendor/bin/codecept run functional
test-acceptance:
	docker compose exec php ./vendor/bin/codecept run acceptance
test-clean:
	docker compose exec php ./vendor/bin/codecept clean
## FRONT
### NPM
npm-install:
	docker compose exec php npm install
npm-cache-clean:
	docker compose exec php npm cache clean --force
npm-update:
	docker compose exec php npm update
npm-repair:
	docker compose exec php npm audit fix
npm-fund:
	docker compose exec php npm fund
### ENCORE
encore-dev:
	docker compose exec php npm run dev
encore-watch:
	docker compose exec php npm run watch
encore-prod:
	docker compose exec php npm run build
### ASSETS
assets-install:
	docker compose exec php bin/console assets:install --symlink public
fos-routes-dump:
	docker compose exec php bin/console fos:js-routing:dump --format=json --target=assets/js/fos_routing/_routes.json
assets-all-dev: assets-install fos-routes-dump npm-install encore-dev
assets-all-prod: assets-install fos-routes-dump npm-install encore-prod
assets-watch: assets-install fos-routes-dump encore-watch
## Doctrine
# PHP APP
# DATABASE
db-create:
	docker compose exec php bin/console doctrine:d:c --env=test
db-update-schema:
	docker compose exec php bin/console doctrine:migrations:migrate --no-interaction
db-dump-schema:
	docker compose exec php bin/console doctrine:migrations:dump-schema

db-migrations-generate:
	docker compose exec php bin/console doctrine:migrations:gene

db-migrations-update:
	docker compose exec php bin/console doctrine:migrations:migrate
# DATABASE
# > Git hub action
test-actions:
	act