<?php

use Faker\Generator as Faker;

$factory->define(
    App\Notice::class, 
    function (Faker $faker) {
        return [
            'uuid'     => $faker->uuid(),
            'writer'        => App\user::pluck('uuid')->random(),
            'content'       => $faker->text(200),
            'notice_range'  => array_rand(array_flip(['all', 'group', 'person'])),
            'notice_for'    => App\user::pluck('uuid')->random(),
        ];
    }
);
