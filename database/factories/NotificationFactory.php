<?php
/**
 * PHP version 7.0
 * 
 * @category Factory
 * @package  Global
 * @author   bs Kwon <rnjs9957@gmail.com>
 * @license  MIT license
 * @link     https://github.com/3wdj-team1/HIKONNECT_WEB
 */
use Faker\Generator as Faker;

$factory->define(
    App\Models\Notification::class, 
    function (Faker $faker) {
        return [
            'uuid'          => $faker->uuid(),
            'writer'        => App\Models\User::pluck('uuid')->random(),
            'title'         => $faker->realText(20),
            'content'       => $faker->realText(200),
            'hits'          => rand(0, 200),
        ];
    }
);
