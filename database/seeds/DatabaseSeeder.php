<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // factory(App\Models\User::class, 100)->create();
        // factory(App\Models\HikingGroup::class, 100)->create();
        // factory(App\Models\Announce::class, 100)->create();
        // factory(App\Models\EntryInfo::class, 100)->create();
        // factory(App\Models\HikingPlan::class, 100)->create();
        // factory(App\Models\HikingRecord::class, 100)->create();
        // factory(App\Models\LocationMemo::class, 100)->create();
        // factory(App\Models\Notification::class, 100)->create();
        // factory(App\Models\RadiogramLog::class, 100)->create();
        // factory(App\Models\Recruitment::class, 100)->create();
        // factory(App\Models\UserPosition::class, 100)->create();
        factory(App\Models\UserProfile::class, 100)->create();
    }
}