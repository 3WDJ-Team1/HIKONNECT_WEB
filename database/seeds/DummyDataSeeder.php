<?php

use Illuminate\Database\Seeder;

class DummyDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(\Faker\Generator $faker)
    {
        factory(App\Models\User::class, 100)->create();
        factory(App\Models\HikingGroup::class, 100)->create();
        factory(App\Models\Announce::class, 100)->create();
        factory(App\Models\EntryInfo::class, 100)->create();
        factory(App\Models\HikingPlan::class, 100)->create();
        factory(App\Models\HikingRecord::class, 100)->create();
        factory(App\Models\LocationMemo::class, 100)->create();
        factory(App\Models\Notification::class, 100)->create();
        factory(App\Models\RadiogramLog::class, 100)->create();
        factory(App\Models\Recruitment::class, 100)->create();
        factory(App\Models\UserPosition::class, 100)->create();
        factory(App\Models\UserProfile::class, 100)->create();

        DB::table('user_profile')->truncate();

        $faker = Faker\Factory::create();

        DB::table('user_profile')->truncate();

        $userUUIDs = DB::table('user')->pluck('uuid')->all();
        $arrayLength = count($userUUIDs);
        $data = [];

        for ($i = 0; $i < $arrayLength; $i++) {
            $data[] = [
                'uuid'          => $faker->uuid(),
                'user'          => array_shift($userUUIDs),
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

        DB::table('user_profile')->insert($data);
    }
}
