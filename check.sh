#!/bin/bash
./loadDbTest.sh && ./vendor/bin/phpcs -p --standard=PSR2 --extensions=php,twig src/ && ./vendor/bin/phpunit -c app
