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
    App\Models\HikingRecord::class, 
    function (Faker $faker) {
        $created_date = $faker->dateTimeBetween(
            '-2 years',
            date_default_timezone_get()
        );

        $updated_date = (
            new DateTime(
                $created_date->format("Y-m-d H:m:s")
            )
        )->modify("+1 hour");

        return [
            'uuid'          => $faker->uuid(),
            'owner'         => App\Models\User::pluck('uuid')->random(),
            'hiking_plan'   => App\Models\HikingPlan::pluck('uuid')->random(),
            'avg_speed'     => rand(0.00, 20.00),
            'rank'          => rand(0, 50),
            'created_at'    => $created_date,
            'updated_at'    => $updated_date,
        ];
    }
);
