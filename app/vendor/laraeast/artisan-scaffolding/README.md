# Artisan Scaffolding

This package adds some artisan commands to generate `relations`, `helpers`, `scopes`, `concerns`, `mutators`, `transformers` files and override the laravel original  artisan commands as your like.

> NOTE : the view artisan commands was forked from [sven/artisan-view](https://github.com/svenluijten/artisan-view)
 

## Installation
Via [composer](http://getcomposer.org):

```bash
composer require laraeast/artisan-scaffolding
```

Or add the package to your dependencies in `composer.json` and run
`composer update` to download the package:

```json
{
    "require": {
        "laraeast/artisan-scaffolding": "^1.1"
    }
}
```

**Note:** If you're using Laravel 5.5, you're done! The service provider is automatically registered in the container,
thanks to [auto-discovery](https://medium.com/@taylorotwell/package-auto-discovery-in-laravel-5-5-ea9e3ab20518).

Next, add the `ServiceProvider` to your `providers` array in `config/app.php`:

```php
// config/app.php
'providers' => [
    ...
    Laraeast\Artisan\Scaffolding\Providers\ServiceProvider::class,
];
```

## Usage
If you now run `php artisan` you can see 8 new commands:
- `make:helper`
- `make:mutator`
- `make:relation`
- `make:scope`
- `make:concern`
- `make:transformer`
- `make:view`
- `scrap:view`

These commands was overrided by this package :
 - `make:model` : add the fillable as default.
 - `make:controller` : add generate request option and generate full resource, nested controller .
 - `make:policy` : add `listing` method and replace the `user` variable name to `auther` if the created policy file name is user
 - `make:request` : division the rules by method name and change the `authorize` method return to true by default.
 
If you want to change your project character run this command to publish the config file :
```
php artisan vendor:publish --provider=Laraeast\Artisan\Scaffolding\Providers\ServiceProvider --tag=config
```
```
// config/artisan-scaffolding.php

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
```

If you want to change stubs files content run this command :
```
php artisan vendor:publish --provider=Laraeast\Artisan\Scaffolding\Providers\ServiceProvider --tag=stubs
```
Now you can see the stubs files in this path `app\Console\stubs`


## License
`sven/artisan-view` is licensed under the MIT License (MIT). Please see the
[license file](LICENSE.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/sven/artisan-view.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-green.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/sven/artisan-view.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/svenluijten/artisan-view.svg?style=flat-square
[ico-codeclimate]: https://img.shields.io/codeclimate/github/svenluijten/artisan-view.svg?style=flat-square
[ico-quality]: https://img.shields.io/scrutinizer/g/svenluijten/artisan-view.svg?style=flat-square
[ico-styleci]: https://styleci.io/repos/56054783/shield

[link-packagist]: https://packagist.org/packages/sven/artisan-view
[link-downloads]: https://packagist.org/packages/sven/artisan-view
[link-travis]: https://travis-ci.org/svenluijten/artisan-view
[link-codeclimate]: https://codeclimate.com/github/svenluijten/artisan-view
[link-quality]: https://scrutinizer-ci.com/g/svenluijten/artisan-view/?branch=master
[link-styleci]: https://styleci.io/repos/56054783
