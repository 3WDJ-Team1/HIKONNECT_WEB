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
    App\Models\Group::class, 
    function (Faker $faker) {
        return [
            'uuid'              => $faker->uuid(),
            'group_name'        => $faker->realText(20),
            'group_owner'       => App\Models\User::pluck('uuid')->random(),
            'mountain'          => "소백산",
            'starting_point'    => 'starting_point dump',
            'stopover'          => 'stopover dump',
            'destination'       => 'destination dump',
            'start_date'        => $faker->dateTimeThisMonth('now'),
            'min_grouper'       => '5',
            'max_grouper'       => '20',
        ];
    }
);
