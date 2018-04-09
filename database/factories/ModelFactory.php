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

$factory->define(
    App\Models\EntryInfo::class, 
    function (Faker $faker) {
        return [
            'uuid'          => $faker->uuid(),
            'user'          => App\Models\User::pluck('uuid')->random(),
            'hiking_group'  => App\Models\HikingGroup::pluck('uuid')->random(),
            'is_accepted'   => rand(0, 1),
        ];
    }
);

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

$factory->define(
    App\Models\HikingPlan::class, 
    function (Faker $faker) {
        return [
            'uuid'              => $faker->uuid(),
            'hiking_group'      => App\Models\HikingGroup::pluck('uuid')->random(),
            'start_date'        => $faker->dateTimeThisMonth(),
            'starting_point'    => '[]',
            'stopover'          => '[]',
            'end_point'         => '[]',
            'created_at'        => $faker->dateTimeBetween(
                '-2 years',
                date_default_timezone_get()
            )
        ];
    }
);

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

$factory->define(
    App\Models\LocationMemo::class, 
    function (Faker $faker) {
        return [
            'uuid'          => $faker->uuid(),
            'writer'        => App\Models\User::pluck('uuid')->random(),
            'hiking_group'  => App\Models\HikingGroup::pluck('uuid')->random(),
            'position'      => '[]',
            'title'         => $faker->realText(20),
            'content'       => $faker->realText(200),
            'image_path'    => 'File_path'
        ];
    }
);

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

$factory->define(
    App\Models\RadiogramLog::class, 
    function (Faker $faker) {
        return [
            'uuid'              => $faker->uuid(),
            'hiking_group'      => App\Models\HikingGroup::pluck('uuid')->random(),
            'sender'            => App\Models\User::pluck('uuid')->random(),
            'radiogram_path'    => 'File_path'
        ];
    }
);

$factory->define(
    App\Models\Recruitment::class, 
    function (Faker $faker) {
        return [
            'uuid'          => $faker->uuid(),
            'hiking_group'  => App\Models\HikingGroup::Pluck('uuid')->random(),
            'title'         => $faker->realText(20),
            'content'       => $faker->realText(200),
            'hits'          => rand(0, 1000),
        ];
    }
);

$factory->define(
    App\Models\User::class,
    function (Faker $faker) {
        return [
            'uuid'              => $faker->uuid(),
            'id'                => $faker->userName(),
            'password'          => $faker->password(),
        ];
    }
);

$factory->define(
    App\Models\UserPosition::class, 
    function (Faker $faker) {
        return [
            'uuid'          => $faker->uuid(),
            'user'          => App\Models\User::Pluck('uuid')->random(),
            'hiking_group'  => App\Models\HikingGroup::Pluck('uuid')->random(),
            'position'      => '[]',
        ];
    }
);

$factory->define(
    App\Models\UserProfile::class, 
    function (Faker $faker) {

        return [
            'uuid'          => $faker->uuid(),
            'user'          => function () {
                return factory(App\Models\User::class)->create()->uuid;
            },
            'nickname'      => $faker->lastName(),
            'image_path'    => $faker->imageUrl(640, 400),
            'phone'         => '010-0000-0000',
            'gender'        => rand(0, 1),
            'age_group'     => array_rand(
                array_flip(["10", "20", "30", "40", "50"])
            ),
            'scope'         => array_rand(
                array_flip(["00000", "10111", "10110", "10100", "01111", "01011"])
            ),
        ];
    }
);