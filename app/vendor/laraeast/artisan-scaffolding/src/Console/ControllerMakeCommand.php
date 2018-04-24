<?php

namespace Laraeast\Artisan\Scaffolding\Console;

use Illuminate\Support\Str;
use InvalidArgumentException;
use Illuminate\Support\Facades\Config;
use Illuminate\Console\GeneratorCommand;
use Symfony\Component\Console\Input\InputOption;

class ControllerMakeCommand extends GeneratorCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'make:controller';

    /**
     * Determine if the model class exists or not.
     *
     * @var bool
     */
    protected $modelExists = false;

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new controller class';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Controller';

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        if ($this->option('parent')) {

            return file_exists(app_path('Console/stubs/controller.nested.stub')) ?
                app_path('Console/stubs/controller.nested.stub') :
                __DIR__.'/stubs/controller.nested.stub';
        } elseif ($this->option('model')) {

            return file_exists(app_path('Console/stubs/controller.model.stub')) ?
                app_path('Console/stubs/controller.model.stub') :
                __DIR__.'/stubs/controller.model.stub';
        } elseif ($this->option('resource')) {

            return file_exists(app_path('Console/stubs/controller.stub')) ?
                app_path('Console/stubs/controller.stub') :
                __DIR__.'/stubs/controller.stub';
        }

        return file_exists(app_path('Console/stubs/controller.plain.stub')) ?
            app_path('Console/stubs/controller.plain.stub') :
            __DIR__.'/stubs/controller.plain.stub';
    }

    /**
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return Config::get('artisan-scaffolding.controllers_default_namespace',
            $rootNamespace.'\Http\Controllers');
    }

    /**
     * Build the class with the given name.
     *
     * Remove the base controller import if we are already in base namespace.
     *
     * @param  string  $name
     * @return string
     */
    protected function buildClass($name)
    {
        $controllerNamespace = $this->getNamespace($name);

        $replace = [
            'FullRequestClass' => 'Illuminate\Http\Request',
            'RequestClass' => 'Request',
        ];

        if ($this->option('request')) {
            $replace = $this->buildRequestReplacements($replace);
        }

        if ($this->option('parent')) {
            $replace = array_merge($replace, $this->buildParentReplacements());
        }

        if ($this->option('model')) {
            $replace = $this->buildModelReplacements($replace);
        }

        $replace["use {$controllerNamespace}\Controller;\n"] = '';

        return str_replace(
            array_keys($replace), array_values($replace), parent::buildClass($name)
        );
    }

    /**
     * Build the replacemnets for a parent controller.
     *
     * @return array
     */
    protected function buildParentReplacements()
    {
        $parentModelClass = $this->parseModel($this->option('parent'));

        if (! class_exists($parentModelClass)) {
            if ($this->confirm("A {$parentModelClass} model does not exist. Do you want to generate it?", true)) {
                $this->call('make:model', ['name' => $parentModelClass]);
            }
        }

        return [
            'ParentDummyFullModelClass' => $parentModelClass,
            'ParentDummyModelClass' => class_basename($parentModelClass),
            'ParentDummyModelVariable' => lcfirst(class_basename($parentModelClass)),
            'ParentDummyModelPluralVariable' => Str::plural(lcfirst(class_basename($parentModelClass))),
        ];
    }

    /**
     * Build the replacemnets for the request class.
     *
     * @return array
     */
    protected function buildRequestReplacements()
    {

        $request = $this->parseRequest($this->option('request'));

        if (! class_exists($request)) {
            if ($this->confirm("A {$request} class does not exist. Do you want to generate it?", true)) {
                $this->call('make:request', ['name' => class_basename($request)]);
            }
        }

        return [

            'FullRequestClass' => $request,
            'RequestClass' => class_basename($request),
        ];
    }

    /**
     * Build the model replacement values.
     *
     * @param  array  $replace
     * @return array
     */
    protected function buildModelReplacements(array $replace)
    {
        $modelClass = $this->parseModel($this->option('model'));

        if (! class_exists($modelClass)) {
            if ($this->confirm("A {$modelClass} model does not exist. Do you want to generate it?", true)) {
                $this->call('make:model', ['name' => class_basename($modelClass)]);
            }
        }

        return array_merge($replace, [
            'DummyFullModelClass' => $modelClass,
            'DummyModelClass' => class_basename($modelClass),
            'DummyModelVariable' => lcfirst(class_basename($modelClass)),
            'DummyModelPluralVariable' => Str::plural(lcfirst(class_basename($modelClass))),
        ]);
    }

    /**
     * Get the fully-qualified model class name.
     *
     * @param  string  $model
     * @return string
     */
    protected function parseModel($model)
    {
        if (preg_match('([^A-Za-z0-9_/\\\\])', $model)) {
            throw new InvalidArgumentException('Model name contains invalid characters.');
        }

        $model = trim(str_replace('/', '\\', $model), '\\');

        if (! Str::startsWith($model, $rootNamespace = $this->getModelsNamespace())) {
            $model = $rootNamespace.$model;
        }

        return $model;
    }

    /**
     * Get the fully-qualified model class name.
     *
     * @param  string  $request
     * @return string
     */
    protected function parseRequest($request)
    {
        if (preg_match('([^A-Za-z0-9_/\\\\])', $request)) {
            throw new InvalidArgumentException('Request name contains invalid characters.');
        }

        $request = trim(str_replace('/', '\\', $request), '\\');

        if (! Str::startsWith($request, $rootNamespace = $this->getRequestNamespace())) {
            $request = $rootNamespace.$request;
        }

        return $request;
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
            ['model', 'm', InputOption::VALUE_OPTIONAL, 'Generate a resource controller for the given model.'],

            ['resource', 'r', InputOption::VALUE_OPTIONAL, 'Generate a resource controller class.'],

            ['request', 's', InputOption::VALUE_OPTIONAL, 'Generate a request file for controller class.'],

            ['parent', 'p', InputOption::VALUE_OPTIONAL, 'Generate a nested resource controller class.'],
        ];
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
     * Get the requests namespace.
     *
     * @return string
     */
    protected function getRequestNamespace()
    {
        $namespace = Config::get('artisan-scaffolding.requests_default_namespace', $this->rootNamespace().'Http\Requests');

        if (Str::endsWith($namespace, '\\')) {
            return $namespace;
        }

        return $namespace.'\\';
    }
}
