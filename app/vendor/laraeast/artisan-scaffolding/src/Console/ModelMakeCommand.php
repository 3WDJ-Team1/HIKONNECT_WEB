<?php

namespace Laraeast\Artisan\Scaffolding\Console;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Config;

class ModelMakeCommand extends \Illuminate\Foundation\Console\ModelMakeCommand
{
    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return file_exists(app_path('Console/stubs/model.stub')) ?
            app_path('Console/stubs/model.stub') :
            __DIR__.'/stubs/model.stub';
    }

    /**
     * Get the default namespace for the class.
     *
     * @param  string $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $this->getModelsNamespace();
    }

    /**
     * Get the models namespace.
     *
     * @return string
     */
    protected function getModelsNamespace()
    {
        $namespace = Config::get('artisan-scaffolding.models_default_namespace', $this->rootNamespace());

        if (Str::endsWith($namespace, '\\')) {
            return substr($namespace, -1);
        }
        return $namespace;
    }
}
