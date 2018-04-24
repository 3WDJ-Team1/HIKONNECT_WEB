<?php

namespace Laraeast\Artisan\Scaffolding\Console;

use Illuminate\Support\Facades\Config;
use Illuminate\Console\GeneratorCommand;

class ConcernMakeCommand extends GeneratorCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'make:concern';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new concern trait';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Concern';

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return file_exists(app_path('Console/stubs/concern.stub')) ?
            app_path('Console/stubs/concern.stub') :
            __DIR__.'/stubs/concern.stub';
    }

    /**
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return Config::get('artisan-scaffolding.concerns_default_namespace',
            $rootNamespace.'\Concerns');
    }
}
