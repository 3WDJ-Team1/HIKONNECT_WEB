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
use App\Request;

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
     * @param int $pageIndex |  
     * @param int $perPage   | 
     * 
     * @return Array
     */
    public function getNotifications(int $pageIndex = 0, int $perPage = 10)
    {
        return Notice::skip(10)->take(5)->get();
    }

    /**
     * Update notification
     * 
     * @param Array  $inputData | Form input data from browser.
     *                          | [
     *                          |    "uuid"          Record ID
     *                          |    "writer_id"     Writer ID in User table
     *                          |    "content"       Notice Content
     *                          |    "notice_range"  Range 
     *                          |    "notice_for"    
     *                          | ]
     * @param String $uuid      |
     * 
     * @return void
     */
    public function updateNotification(Array $inputData, String $uuid)
    {
        return Notice::where('uuid', $uuid)
        ->update($inputData);
    }

    /**
     * Delete notification
     * 
     * @param String $uuid | Notification's ID
     * 
     * @return void
     */
    public function deleteNotification(String $uuid)
    {
        return $uuid;
        // Notice::where('uuid', $uuid)
        // ->delete();
    }

    /**
     * Create Notification
     * 
     * @param Array $inputData | Form input data from browser.
     *                         | [
     *                         |    "writer_id"     Writer ID in User table
     *                         |    "content"       Notice Content
     *                         |    "notice_range"  Range 
     *                         |    "notice_for"    
     *                         | ]
     * 
     * @return void
     */
    public function insertNotification(Array $inputData)
    {
        Notice::insert($inputData);
    }
}
