Symfony Upfit
========================

    curl -s https://getcomposer.org/installer | php
    sudo setfacl -R -m u:www-data:rwx -m u:`whoami`:rwx app/cache app/logs
    sudo setfacl -dR -m u:www-data:rwx -m u:`whoami`:rwx app/cache app/logs
    composer.phar update


[Visionneur markdown](http://daringfireball.net/projects/markdown/dingus)
