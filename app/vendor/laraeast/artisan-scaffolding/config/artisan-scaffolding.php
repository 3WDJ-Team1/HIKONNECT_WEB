<?php
return [
    /**
     * the default namespace for the models classes.
     *
     * if you change the default namespace you need to change user model namespace in these files :-
     * - config/auth.php
     * - config/services.php
     * - app/Http/Controllers/Auth/RegisterController.php
     * - database/factories/ModelFactory.php
     *
     */
    'models_default_namespace' => 'App\Models',

    /**
     * the default namespace for the relations traits.
     *
     */
    'relations_default_namespace' => 'App\Models\Relations',

    /**
     * the default namespace for the concerns traits.
     *
     */
    'concerns_default_namespace' => 'App\Models\Concerns',

    /**
     * the default namespace for the mutators traits.
     *
     */
    'mutators_default_namespace' => 'App\Models\Mutators',

    /**
     * the default namespace for the scopes traits.
     *
     */
    'scopes_default_namespace' => 'App\Models\Scopes',

    /**
     * the default namespace for the helpers traits.
     *
     */
    'helpers_default_namespace' => 'App\Helpers',

    /**
     * the default namespace for the policies classes.
     *
     */
    'policies_default_namespace' => 'App\Policies',

    /**
     * the default namespace for the requests classes.
     *
     */
    'requests_default_namespace' => 'App\Http\Requests',

    /**
     * the default namespace for the controllers classes.
     *
     */
    'controllers_default_namespace' => 'App\Http\Controllers',

    /**
     * the default namespace for the transformer classes.
     *
     */
    'transformers_default_namespace' => 'App\Models\Transformers',
];
