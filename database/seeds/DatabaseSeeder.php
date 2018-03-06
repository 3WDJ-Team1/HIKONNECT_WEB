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
        factory(App\Models\User::class, 20)->create();
        factory(App\Models\Notice::class, 20)->create();
        factory(App\Models\Group::class, 20)->create();
    }
}
