#!/bin/sh
pear config-set auto_discover 1
pear channel-discover pear.phing.info
pear channel-discover pear.phpdoc.org
pear channel-discover pear.phpunit.de
pear channel-discover pear.pdepend.org
pear channel-discover pear.phpmd.org
pear install --alldeps pdepend/PHP_Depend-beta
pear install --alldeps phing/phing-alpha
sud
pear install --alldeps phpunit/PHP_CodeBrowser
pear install --alldeps phpunit/PHP_CodeCoverage
pear install --alldeps phpunit/phploc
pear install --alldeps phpunit/phpcpd
pear install --alldeps phpdoc/phpDocumentor-alpha
pear install --alldeps phpmd/PHP_PMD
pear install --alldeps PHP_CodeSniffer
# git clone git://github.com/opensky/Symfony2-coding-standard.git /usr/share/php/PHP/CodeSniffer/Standards/Symfony2

