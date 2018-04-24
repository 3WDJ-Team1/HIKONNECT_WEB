<?php

namespace Laraeast\Artisan\Scaffolding\Console;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Config;
use Illuminate\Console\GeneratorCommand;
use Symfony\Component\Console\Input\InputOption;

class RelationMakeCommand extends GeneratorCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'make:relation';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new relation trait';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Relation';

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return file_exists(app_path('Console/stubs/relation.stub')) ?
            app_path('Console/stubs/relation.stub') :
            __DIR__.'/stubs/relation.stub';
    }

    /**
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return Config::get('artisan-scaffolding.relations_default_namespace',
            $rootNamespace.'\Relations');
    }
}
