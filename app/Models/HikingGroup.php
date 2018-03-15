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
use Illuminate\Support\Facades\DB;

use App\Models\HikingGroup;

/**
 * Model for Notification
 * 
 * @category Model
 * @package  App
 * @author   bs Kwon <rnjs9957@gmail.com>
 * @license  MIT license
 * @link     https://github.com/3WDJ-Team1/HIKONNECT_WEB
 */

class HikingGroup extends Model
{
    protected $table = 'hiking_group';

    /**
     * 
     */
    public function getGroupMembers(String $groupUuid)
    {
        $queryRes = DB::table('entry_info')
            ->leftJoin('hiking_group', 'hiking_group.uuid', 'entry_info.hiking_group')
            ->leftJoin('user', 'entry_info.user', 'user.uuid')
            ->leftJoin('user_profile', 'user.uuid', 'user_profile.user')
            ->select('hiking_group.uuid as groupUUID', 'hiking_group.name as groupName', 'user_profile.nickname as userNickname', 'user_profile.gender as userGender')
            ->where('hiking_group.uuid', $groupUuid)
            // ->orderBy('userNickname', 'desc')
            ->get();
        return $queryRes;
    }
}
