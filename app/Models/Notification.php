<?php
/**
 * PHP version 7.0
 * 
 * @category Model
 * @package  App\Models
 * @author   bs Kwon <rnjs9957@gamil.com>
 * @license  MIT license
 * @link     https://github.com/3WDJ-Team1/HIKONNECT_WEB
 */
namespace App\Models;

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
class Notification extends Model
{
    protected $table = 'notification';

    /**
     * Get notification list from database
     * 
     * @param int $pageIndex |  
     * @param int $perPage   | 
     * 
     * @return Array
     */
    public function getNotifications($groupUuid, int $pageIndex = 0, int $perPage = 5)
    {
        return Notification::
            leftJoin(
                'user_profile', 
                'notification.writer', 
                '=', 
                'user_profile.user'
            )->select(
                'notification.uuid', 
                'user_profile.nickname', 
                'notification.title', 
                'notification.content', 
                'notification.hits',
                'notification.created_at',
                'notification.updated_at'
            )->where(
                'user_profile.hiking_group',
                $groupUuid
            )->skip($pageIndex)
            ->take($perPage)
            ->get();
    }

    /**
     * Get 1 element from notification table
     * 
     * @param int $id 
     * 
     * @return Array
     */
    public function selectOwn($id)
    {
        return Notification::where('uuid', '=', $id)->get();
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
        return Notification::where('uuid', $uuid)
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
        return Notification::where('uuid', '=', $uuid)
        ->delete();
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
     * 
     * @todo 
     *          inputdata
     *              작성자      writer     user's uuid
     *              타이틀      title      notification's title
     *              내용        content    notification's content
     * 
     *          추가해야 할 데이터
     *              조회수      hits        DB의 값 참조
     *              생성 시간   created_at  
     *              수정 시간   updated_at  
     */
    public function insertNotification(Array $inputData)
    {
        Notification::insert($inputData);
    }
}
