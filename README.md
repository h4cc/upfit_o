[![Build Status](https://secure.travis-ci.org/bpaulin/upfit.png?branch=master)](https://travis-ci.org/bpaulin/upfit)

Symfony Upfit
========================

    curl -s https://getcomposer.org/installer | php
    composer.phar update --dev


    ./vendor/bin/phing update
    ./vendor/bin/phing check
    ./vendor/bin/phing report


    sudo setfacl -R -m u:www-data:rwx -m u:`whoami`:rwx app/cache app/logs
    sudo setfacl -dR -m u:www-data:rwx -m u:`whoami`:rwx app/cache app/logs


[Visionneur markdown](http://daringfireball.net/projects/markdown/dingus)


    ln -s `pwd`/check.sh .git/hooks/pre-commit
