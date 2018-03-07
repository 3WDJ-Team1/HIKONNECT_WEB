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
    App\Models\Announce::class, 
    function (Faker $faker) {
        return [
            'uuid'          => $faker->uuid(),
            'sender'        => App\Models\User::Pluck('uuid')->random(),
            'addressee'     => App\Models\User::Pluck('uuid')->random(),
            'title'         => $faker->realText(20),
            'content'       => $faker->realText(200),
        ];
    }
);
