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

class UserProfile extends Model
{
    protected $table = 'user_profile';

    /**
     * Get user's profile reference by User's UUID
     * 
     * @param String $userUuid User's UUID
     * 
     * @return Array
     */
    public function getUserProfile(String $userUuid)
    {
        $queryRes = UserProfile::select(
            'user as uuid',
            'nickname as name',
            'gender',
            'phone',
            'image_path as profilePic'
        )->where('user', $userUuid)
        ->get();

        return $queryRes;
    }
}
