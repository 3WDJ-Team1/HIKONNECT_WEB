<?php

use Faker\Generator as Faker;

$factory->define(
    App\Notice::class, 
    function (Faker $faker) {
        return [
            'notice_id'     => $faker->uuid(),
            'writer'        => App\user::pluck('join_id')->random(),
            'content'       => $faker->text(200),
            'notice_range'  => array_rand(array_flip(['all', 'group', 'person'])),
            'notice_for'    => App\user::pluck('join_id')->random(),
        ];
    }
);
