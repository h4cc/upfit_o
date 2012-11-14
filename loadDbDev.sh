#!/bin/sh
php app/console doctrine:database:drop --force --env=dev
php app/console doctrine:database:create --env=dev
php app/console doctrine:schema:update --force --env=dev
php app/console doctrine:fixtures:load --env=dev --append
