<?php

namespace Laraeast\Artisan\Scaffolding\Console;

use Illuminate\Support\Facades\Config;
use Illuminate\Console\GeneratorCommand;

class MutatorMakeCommand extends GeneratorCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'make:mutator';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new mutator trait';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Mutator';

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return file_exists(app_path('Console/stubs/mutator.stub')) ?
            app_path('Console/stubs/mutator.stub') :
            __DIR__.'/stubs/mutator.stub';
    }

    /**
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return Config::get('artisan-scaffolding.mutators_default_namespace',
            $rootNamespace.'\Mutators');
    }
}
