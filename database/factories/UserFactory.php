<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(
    App\User::class,
    function (Faker $faker) {
        return [
            'uuid'           => $faker->uuid(),
            'user_id'           => $faker->userName(),
            'password'          => $faker->password(),
            'nickname'          => $faker->firstName(),
            'user_photo_path'   => $faker->imageUrl(640, 480),
            'phone'             => $faker->e164PhoneNumber(),
            'phone_isopen'      => array_rand([true, false]),
            'gender'            => array_rand(array_flip(['male', 'female'])),
            'gender_isopen'     => array_rand([true, false]),
            'age_group'         => array_rand(array_flip(['10', '20', '30', '40', '50', '60'])),
            'age_group_isopen'  => array_rand([true, false]),
        ];
    }
);
