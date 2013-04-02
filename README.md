[![Build Status](https://secure.travis-ci.org/bpaulin/upfit.png?branch=master)](https://travis-ci.org/bpaulin/upfit)

# Upfit

Avant tout me former, eventuellement servir a gérer des séances de sport

## mise en place

### dépendances

    curl -s https://getcomposer.org/installer | php
    php composer.phar update --dev

### droits

    sudo setfacl -R -m u:www-data:rwx -m u:`whoami`:rwx app/cache app/logs
    sudo setfacl -dR -m u:www-data:rwx -m u:`whoami`:rwx app/cache app/logs

### verif automatique pour un commit

    ln -s `pwd`/check.sh .git/hooks/pre-commit

### création d'une base de dev vierge

	php app/console doctrine:schema:drop --env=prod --force
	php app/console doctrine:database:create --env=dev
	php app/console init:acl
	php app/console doctrine:migrations:migrate --env=dev
	php app/console fos:user:create `whoami` --super --env=dev

## Commandes

### mise à jour

    ./bin/phing update

### vérification (style & test)

    ./bin/phing check

### génération des rapports

    ./bin/phing report

## Mise à jour en production

	git pull
	php app/console doctrine:migrations:migrate --env=prod --no-interaction
	php app/console cache:clear --env=prod
	php app/console assetic:dump --env=prod --no-debug



