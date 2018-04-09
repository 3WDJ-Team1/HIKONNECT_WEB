<?php
/**
 * PHP version 7.0
 * 
 * @category Model
 * @package  App
 * @author   bs Kown <rnjs9957@gmail.com>
 * @license  MIT license
 * @link     https://github.com/3WDJ-Team1/HIKONNECT_WEB
 */
namespace App\Models;

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

class UserPosition extends Model
{
    protected $table = 'user_position';

    /**
     * Get group member's position
     * 
     * @param String $hiking_group 
     * 
     * @return Array
     */
    public function getMemberPosition(String $hiking_group)
    {
        $queryRes = DB::table($table)
        ->select(
            '*'
        )->where(
            'hiking_gorup', $hiking_group
        )->get();

        return $queryRes;
    }
}