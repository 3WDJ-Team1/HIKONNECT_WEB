<?php

namespace Laraeast\Artisan\Scaffolding\Console;


use Illuminate\Support\Facades\Config;

class RequestMakeCommand extends \Illuminate\Foundation\Console\RequestMakeCommand
{
    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return file_exists(app_path('Console/stubs/request.stub')) ?
            app_path('Console/stubs/request.stub') :
            __DIR__.'/stubs/request.stub';
    }

    /**
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return Config::get('artisan-scaffolding.requests_default_namespace',
            $rootNamespace.'\Http\Requests');
    }
}
