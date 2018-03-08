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
    App\Models\Notice::class, 
    function (Faker $faker) {
        return [
            'uuid'          => $faker->uuid(),
            'writer'        => App\Models\user::pluck('uuid')->random(),
            'content'       => $faker->text(200),
            'notice_range'  => array_rand(array_flip(['all', 'group', 'person'])),
            'notice_for'    => App\Models\user::pluck('uuid')->random(),
        ];
    }
);
