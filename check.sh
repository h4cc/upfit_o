#!/bin/bash
./vendor/bin/phpcs -p --standard=PSR2 --extensions=php src/ && ./vendor/bin/phpunit -c app
