<?php

namespace Laraeast\Artisan\Scaffolding\Console;

use Illuminate\Support\Facades\Config;
use Illuminate\Console\GeneratorCommand;

class ScopeMakeCommand extends GeneratorCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'make:scope';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new scope trait';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Scope';

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return file_exists(app_path('Console/stubs/scope.stub')) ?
            app_path('Console/stubs/scope.stub') :
            __DIR__.'/stubs/scope.stub';
    }

    /**
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return Config::get('artisan-scaffolding.scopes_default_namespace',
            $rootNamespace.'\Scopes');
    }
}
