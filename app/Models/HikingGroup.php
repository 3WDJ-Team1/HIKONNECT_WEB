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
    public function getGroupMembers(String $groupUuid, $idx, $perIdx)
    {
        if (is_int($idx) xor is_int($perIdx)) {
            return 0;
        }
        $queryRes = DB::table('entry_info')
            ->select(
                'user_profile.nickname',
                'user_profile.image_path',
                'user_profile.phone',
                'user_profile.gender',
                'user_profile.age_group',
                'user_profile.scope'
            )->leftJoin(
                'user_profile', 
                'entry_info.user', 
                'user_profile.user'
            )->where(
                [
                    ['hiking_group', $groupUuid],
                ]
            )->skip($idx)
            ->take($perIdx)
            ->get();

        return $queryRes;
    }

    /**
     * Get group member's location
     * 
     * @param Request $req 
     * 
     * @return void
     */
    public function getMembersLocation(String $hiking_group) 
    {

        $queryRes = DB::table('user_position')
            ->select('user', 'position')
            ->where('hiking_gruop', $hiking_group)
            ->get();

        return $queryRes;
    }
}
