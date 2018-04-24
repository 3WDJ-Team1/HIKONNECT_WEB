<?php

namespace Laraeast\Artisan\Scaffolding\Console;

use Illuminate\Support\Facades\Config;
use Illuminate\Console\GeneratorCommand;

class HelperMakeCommand extends GeneratorCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'make:helper';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new helper class';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Helper';

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return file_exists(app_path('Console/stubs/helper.stub')) ?
            app_path('Console/stubs/helper.stub') :
            __DIR__.'/stubs/helper.stub';
    }

    /**
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return Config::get('artisan-scaffolding.helpers_default_namespace',
            $rootNamespace.'\Helpers');
    }
}
