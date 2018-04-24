<?php

use Sami\Sami;
use Sami\Version\GitVersionCollection;
use Symfony\Component\Finder\Finder;

$iterator = Finder::create()
    ->files()
    ->name('*.php')
    ->in($dir = __DIR__.'/src')
;

$versions = GitVersionCollection::create($dir)
    ->addFromTags('*')
;

return new Sami($iterator, array(
    'versions'             => $versions,
    'title'                => 'php-vfs API',
    'build_dir'            => __DIR__.'/build/docs/api/%version%',
    'cache_dir'            => __DIR__.'/build/docs/api/%version%',
    'default_opened_level' => 2,
));
