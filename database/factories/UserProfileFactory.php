<?php
/**
 * PHP version 7.0
 * 
 * @category Factory
 * @package  Factory
 * @author   bs Kwon <rnjs9957@gmail.com>
 * @license  MIT license
 * @link     https://github.com/3WDJ-Team1/HIKONNECT_WEB
 */

use Faker\Generator as Faker;

$factory->define(
    App\Models\UserProfile::class, 
    function (Faker $faker) {
        return [
            'uuid'          => $faker->uuid(),
            'user'          => App\Models\User::Pluck('uuid')->random(),
            'nickname'      => $faker->lastName(),
            'image_path'    => $faker->imageUrl(640, 400),
            'phone'         => '010-0000-0000',
            'gender'        => rand(0, 1),
            'age_group'     => array_rand(array_flip(["10", "20", "30", "40", "50"])),
            'scope'         => array_rand(
                array_flip(["00000", "10111", "10110", "10100", "01111", "01011"])
            ),
        ];
    }
);
