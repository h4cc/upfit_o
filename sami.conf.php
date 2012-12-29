<?php

use Sami\Sami;
use Symfony\Component\Finder\Finder;

$iterator = Finder::create()
    ->files()
    ->name('*.php')
    ->exclude('Resources')
    ->exclude('Tests')
    ->in('src')
;

return new Sami($iterator, array(
    'title'                => 'Bpaulin Upfit',
    'build_dir'            => __DIR__.'/build/reports/apidoc',
    'cache_dir'            => __DIR__.'/build/reports/.samicache',
));