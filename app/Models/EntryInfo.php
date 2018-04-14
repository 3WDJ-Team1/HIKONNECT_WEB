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
use DateTime;
use DB;

/**
 * Model for Notification
 * 
 * @category Model
 * @package  App
 * @author   bs Kwon <rnjs9957@gmail.com>
 * @license  MIT license
 * @link     https://github.com/3WDJ-Team1/HIKONNECT_WEB
 */

class EntryInfo extends Model
{
    protected $table = 'entry_info';

    public function getAppliedUsers(String $groupUuid)
    {
        return DB::table('entry_info')
        ->select('user_profile.nickname', 'user_profile.image_path', 'user_profile.phone', 'user_profile.gender', 'user_profile.age_group', 'user_profile.scope')
        ->join('user_profile', 'entry_info.user', '=', 'user_profile.user')
        ->where([
            ['entry_info.hiking_group', '=', $groupUuid],
            ['entry_info.is_accepted', '=', '0']
        ])
        ->get();
    }

    public function applyUserEntry($groupUuid, $userUuid)
    {
        $datetime = new DateTime();
        $now = $datetime->format("Y-m-d H:m:s");

        $queryRes = DB::table('entry_info')
        ->insert(
            [
                'uuid' => "",
                'user' => $userUuid,
                'hiking_group' => $groupUuid,
                'is_accepted' => 0,
                'created_at' => $now,
                'updated_at' => $now
            ]
        );

        if ($queryRes) {
            return 'Success';
        } else {
            return 'Failed';
        }
    }

    public function replyUserEntry($groupUuid, $userUuid, $isAccept)
    {   
        $whereCaluse = [
            ['hiking_group', '=', $groupUuid],
            ['user', '=', $userUuid]
        ];

        return DB::table('entry_info')
            ->where($whereCaluse)
            ->update(['is_accepted' => $isAccept]);
            
    }

    public function rejectUserEntry($groupUuid, $userUuid)
    {
        $whereCaluse = [
            ['hiking_group', '=', $groupUuid],
            ['user', '=', $userUuid]
        ];

        return DB::table('entry_info')
            ->where($whereCaluse)
            ->delete();
    }
}
