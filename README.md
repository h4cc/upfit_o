[![Build Status](https://secure.travis-ci.org/bpaulin/upfit.png?branch=master)](https://travis-ci.org/bpaulin/upfit)

# Symfony Upfit

## mise en place

### dépendances

    curl -s https://getcomposer.org/installer | php
    composer.phar update --dev

### droits

    sudo setfacl -R -m u:www-data:rwx -m u:`whoami`:rwx app/cache app/logs
    sudo setfacl -dR -m u:www-data:rwx -m u:`whoami`:rwx app/cache app/logs

### verif auto pour un commit

    ln -s `pwd`/check.sh .git/hooks/pre-commit

## Commandes

### mise à jour

    ./bin/phing update

### vérification (style & test)

    ./bin/phing check

### génération des rapports

    ./bin/phing report




