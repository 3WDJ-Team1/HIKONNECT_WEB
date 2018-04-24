<?php

namespace Mmieluch\LaravelVfsProvider;

use Illuminate\Support\ServiceProvider;
use League\Flysystem\Vfs\VfsAdapter;
use League\Flysystem\Filesystem;
use VirtualFileSystem\FileSystem as Vfs;

class LaravelVfsServiceProvider extends ServiceProvider
{

    /**
     * {@inheritdoc}
     */
    public function boot()
    {
        $this->app['filesystem']->extend('vfs', function() {
            $vfs = new Vfs;
            $adapter = new VfsAdapter($vfs);
            $filesystem = new Filesystem($adapter);

            return $filesystem;
        });
    }
    
    /**
     * {@inheritdoc}
     */
    public function register()
    {
        //
    }

    /**
     * {@inheritdoc}
     */
    public function provides()
    {
        return ['filesystem.vfs'];
    }

}
