# laravel-vfs-provider

[![Latest Stable Version](https://poser.pugx.org/mmieluch/laravel-vfs-provider/v/stable)](https://packagist.org/packages/mmieluch/laravel-vfs-provider)
[![Total Downloads](https://poser.pugx.org/mmieluch/laravel-vfs-provider/downloads)](https://packagist.org/packages/mmieluch/laravel-vfs-provider)
[![License](https://poser.pugx.org/laravel/framework/license.svg)](https://packagist.org/packages/mmieluch/laravel-vfs-provider)

A service provider intended to use with Laravel 5.x for The League Flysystem's wrapper around PHP-VFS library.

## Installation

1. Update your project dependencies:

   ```bash
   composer require mmieluch/laravel-vfs-provider
   ```

2. Register new service provider in `config/app.php`:

  ```php
  return [
  
      'providers' => [

          ...

          /*
           * 3rd Party Service Providers
           */
          Mmieluch\LaravelVfsProvider\LaravelVfsServiceProvider::class,

      ],
  
  ];
  ```
  
3. Update your `config/filesystems.php` file:

  ```php
  return [
  
      ...
  
      'disks' => [

        // This is just an example name, you can call your disk
        // however you want :)
        'virtual' => [
            'driver' => 'vfs',
        ],

      ],
  
  ];
  ```

---

Now you can start using your new driver, just as you'd use a `local` driver:

```php

// Get a handler for storage...
$storage = app('storage');
// Or, if your VFS disk is not a default one, you need to
// choose it from the pool of available disks.
$storage = app('storage')->disk('virtual');

// And you're ready to use your new virtual filesystem!
$storage->makeDirectory('foo');
$storage->put('foo/bar.txt', 'baz');

$storage->has('foo/bar.txt'); // Returns: true

echo $storage->get('/foo/bar.txt'); // Outputs: baz

// You'd like to use a facade? Why, go ahead!
Storage::put('test.txt', 'All about that bass');
// Again, if your virtual drive is not set as your default:
Storage::disk('virtual')->put('test.txt', 'No treble');
```

For full set of instructions on how to use the Laravel filesystem service visit [Laravel's official documentation](https://laravel.com/docs/master/filesystem)

## TODO

- set up path prefix (configuration `root`), like in other drivers;
- add tests.

## Bugs? Suggestions?

Feel free to file an issue or submit a PR. 

## License

This package is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).
