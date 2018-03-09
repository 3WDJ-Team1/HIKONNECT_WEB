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
    App\Models\HikingGroup::class, 
    function (Faker $faker) {
        return [
            'uuid'          => $faker->uuid(),
            'name'          => $faker->realText(20),
            'owner'         => App\Models\User::pluck('uuid')->random(),
            'max_members'   => rand(1, 5) * 10,
            'min_members'   => rand(1, 5),
        ];
    }
);
