#!/bin/sh
php app/console doctrine:database:drop --force --env=test
php app/console doctrine:database:create --env=test
php app/console doctrine:schema:update --force --env=test
php app/console doctrine:fixtures:load --env=test --append
php app/console cache:clear --env=test
