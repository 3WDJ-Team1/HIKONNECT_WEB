<?php

namespace Laraeast\Artisan\Scaffolding\Console;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Config;

class PolicyMakeCommand extends \Illuminate\Foundation\Console\PolicyMakeCommand
{
    /**
     * Replace the model for the given stub.
     *
     * @param  string $stub
     * @param  string $model
     * @return string
     */
    protected function replaceModel($stub, $model)
    {
        $model = str_replace('/', '\\', $model);
        if (Str::startsWith($model, '\\')) {
            $stub = str_replace('NamespacedDummyModel', trim($model, '\\'), $stub);
            $stub = str_replace('NamespaceDocDummyModel', trim($model, '\\'), $stub);
        } else {
            $stub = str_replace('NamespacedDummyModel', $this->getModelsNamespace().$model, $stub);
            $stub = str_replace('NamespaceDocDummyModel', $this->getModelsNamespace().$model, $stub);
        }

        $model = class_basename(trim($model, '\\'));

        $stub = str_replace('DummyModel', $model, $stub);

        $stub = str_replace('dummyModel', $model == 'User' ? 'model' : Str::camel($model), $stub);

        $stub = str_replace('DummyUserVariable', 'user', $stub);

        $use = 'use '.$this->getModelsNamespace().$model.';';

        $stub = str_replace($use."\n".$use, $use, $stub);

        return str_replace('dummyPluralModel', Str::plural(Str::camel($model)), $stub);
    }

    /**
     * Replace the namespace for the given stub.
     *
     * @param  string $stub
     * @param  string $name
     * @return $this
     */
    protected function replaceNamespace(&$stub, $name)
    {
        $stub = str_replace(['DummyNamespace', 'DummyRootNamespace'],
            [$this->getNamespace($name), $this->getModelsNamespace()], $stub);

        return $this;
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
            return $namespace;
        }

        return $namespace.'\\';
    }

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        if ($this->option('model')){
            return file_exists(app_path('Console/stubs/policy.stub')) ?
                app_path('Console/stubs/policy.stub') :
                __DIR__.'/stubs/policy.stub';
        }

        return file_exists(app_path('Console/stubs/policy.plain.stub')) ?
            app_path('Console/stubs/policy.plain.stub') :
            __DIR__.'/stubs/policy.plain.stub';
    }

    /**
     * Get the default namespace for the class.
     *
     * @param  string $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return Config::get('artisan-scaffolding.policies_default_namespace', $rootNamespace.'\Policies');
    }
}
