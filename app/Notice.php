<?php
/**
 * PHP version 7.0
 * 
 * @category Model
 * @package  App
 * @author   bs Kwon <rnjs9957@gamil.com>
 * @license  MIT license
 * @link     https://github.com/3WDJ-Team1/HIKONNECT_WEB
 */
namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Model for Notification
 * 
 * @category Model
 * @package  App
 * @author   bs Kwon <rnjs9957@gmail.com>
 * @license  MIT license
 * @link     https://github.com/3WDJ-Team1/HIKONNECT_WEB
 */
class Notice extends Model
{
    protected $table = 'notice';

    /**
     * Get notification list from database
     * 
     * @return Array
     */
    public function getNotifications()
    {
        DB::table(TABLE_NAME)->get();
        return ;
    }
}
