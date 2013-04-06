#!/bin/sh
git pull
php app/console doctrine:migrations:migrate --env=prod --no-interaction
php app/console cache:clear --env=prod
php app/console assetic:dump --env=prod --no-debug
