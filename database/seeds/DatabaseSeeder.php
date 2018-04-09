<?php
/**
 * PHP version 7.0
 * 
 * @category Seeder
 * @package  Global
 * @author   bs Kwon <rnjs9957@gmail.com>
 * @license  MIT license
 * @link     https://github.com/3wdj-team1/HIKONNECT_WEB
 */
use Illuminate\Database\Seeder;
use Faker as Faker;

/**
 * Seeder for database
 * 
 * @category Seeder
 * @package  Global
 * @author   bs Kwon <rnjs9957@gmail.com>
 * @license  MIT license
 * @link     https://github.com/3wdj-team1/HIKONNECT_WEB
 */

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(DummyDataSeeder::class);

        factory(App\Models\UserProfile::class, 100)->create();
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
    }
}