<?php

namespace Laraeast\Artisan\Scaffolding\Providers;

use Illuminate\Contracts\Foundation\Application;
use Laraeast\Artisan\Scaffolding\Console\ModelMakeCommand;
use Laraeast\Artisan\Scaffolding\Console\ScopeMakeCommand;
use Laraeast\Artisan\Scaffolding\Console\PolicyMakeCommand;
use Laraeast\Artisan\Scaffolding\Console\HelperMakeCommand;
use Laraeast\Artisan\Scaffolding\Console\ConcernMakeCommand;
use Laraeast\Artisan\Scaffolding\Console\FactoryMakeCommand;
use Laraeast\Artisan\Scaffolding\Console\MutatorMakeCommand;
use Laraeast\Artisan\Scaffolding\Console\RequestMakeCommand;
use Laraeast\Artisan\Scaffolding\Console\RelationMakeCommand;
use Laraeast\Artisan\Scaffolding\Console\ControllerMakeCommand;
use Laraeast\Artisan\Scaffolding\Console\TransformerMakeCommand;
use Illuminate\Foundation\Providers\ArtisanServiceProvider as Provider;

class ArtisanServiceProvider extends Provider
{
    /**
     * Create a new service provider instance.
     *
     * @param  \Illuminate\Contracts\Foundation\Application $app
     * @return void
     */
    public function __construct(Application $app)
    {
        parent::__construct($app);

        $this->devCommands = array_merge($this->devCommands, [
            'TransformerMake' => 'command.transformer.make',
            'RelationMake' => 'command.relation.make',
            'ConcernMake' => 'command.concern.make',
            'MutatorMake' => 'command.mutator.make',
            'HelperMake' => 'command.helper.make',
            'ScopeMake' => 'command.scope.make',
            'FactoryMake' => 'command.factory.make',
        ]);
    }

    /**
     * Register the command.
     *
     * @return void
     */
    protected function registerTransformerMakeCommand()
    {
        $this->app->singleton('command.transformer.make', function ($app) {
            return new TransformerMakeCommand($app['files']);
        });
    }

    /**
     * Register the command.
     *
     * @return void
     */
    protected function registerRelationMakeCommand()
    {
        $this->app->singleton('command.relation.make', function ($app) {
            return new RelationMakeCommand($app['files']);
        });
    }

    /**
     * Register the command.
     *
     * @return void
     */
    protected function registerFactoryMakeCommand()
    {
        $this->app->singleton('command.factory.make', function ($app) {
            return new FactoryMakeCommand($app['files']);
        });
    }

    /**
     * Register the command.
     *
     * @return void
     */
    protected function registerConcernMakeCommand()
    {
        $this->app->singleton('command.concern.make', function ($app) {
            return new ConcernMakeCommand($app['files']);
        });
    }

    /**
     * Register the command.
     *
     * @return void
     */
    protected function registerMutatorMakeCommand()
    {
        $this->app->singleton('command.mutator.make', function ($app) {
            return new MutatorMakeCommand($app['files']);
        });
    }

    /**
     * Register the command.
     *
     * @return void
     */
    protected function registerScopeMakeCommand()
    {
        $this->app->singleton('command.scope.make', function ($app) {
            return new ScopeMakeCommand($app['files']);
        });
    }

    /**
     * Register the command.
     *
     * @return void
     */
    protected function registerHelperMakeCommand()
    {
        $this->app->singleton('command.helper.make', function ($app) {
            return new HelperMakeCommand($app['files']);
        });
    }

    /**
     * Register the command.
     *
     * @return void
     */
    protected function registerModelMakeCommand()
    {
        $this->app->singleton('command.model.make', function ($app) {
            return new ModelMakeCommand($app['files']);
        });
    }

    /**
     * Register the command.
     *
     * @return void
     */
    protected function registerPolicyMakeCommand()
    {
        $this->app->singleton('command.policy.make', function ($app) {
            return new PolicyMakeCommand($app['files']);
        });
    }

    /**
     * Register the command.
     *
     * @return void
     */
    protected function registerRequestMakeCommand()
    {
        $this->app->singleton('command.request.make', function ($app) {
            return new RequestMakeCommand($app['files']);
        });
    }

    /**
     * Register the command.
     *
     * @return void
     */
    protected function registerControllerMakeCommand()
    {
        $this->app->singleton('command.controller.make', function ($app) {
            return new ControllerMakeCommand($app['files']);
        });
    }

}
