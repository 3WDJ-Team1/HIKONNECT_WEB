<?php
/**
 * PHP version 7.0
 * Model for Hiking_group
 *
 * @category Models
 * @package  App
 * @author   Areum Lee <leear5799@gmail.com>, Bs Kwon <rnjs9957@gamil.com>
 * @license  MIT license
 * @link     https://github.com/3WDJ-Team1/HIKONNECT_WEB
 */
namespace App\Models;
use App\Request;
use Illuminate\Support\Facades\DB;
use App\Models\HikingGroup;
use Illuminate\Support\Carbon;
/**
 * Model for Notification
 *
 * @category Model
 * @package  App
 * @author   bs SongSol <thdthf159@gmail.com>
 * @license  MIT license
 * @link     https://github.com/3WDJ-Team1/HIKONNECT_WEB
 */
use Illuminate\Database\Eloquent\Model;
/**
 * @var Table     $table              Tables names used in this model
 */
class HikingGroup extends Model
{
    protected   $table      = 'hiking_group';

    public function getGroupList($page,$select,$input)
    {
        if ($select == 'writer') {
            return HikingGroup::where([
                ['leader', 'LIKE', "%$input%"]
            ])
                ->select(
                    'uuid','title','content','us.nickname','min_member','max_member'
                )->join(
                    'user as us',
                    'us.userid',
                    '=',
                    'hiking_group.leader'
                )
                ->orderBy('hiking_group.created_at','DESC')
                ->skip($page)
                ->take(10)
                ->get();
        }
        elseif ($select == 'groupname') {
            return HikingGroup::where([
                ['title', 'LIKE', "%$input%"]
            ])
                ->select(
                    'uuid','title','hiking_group.content','us.nickname','min_member','max_member'
                )->join(
                    'user as us',
                    'us.userid',
                    '=',
                    'hiking_group.leader'
                )
                ->orderBy('hiking_group.created_at','DESC')
                ->skip($page)
                ->take(10)
                ->get();
        }
        else {
            return HikingGroup::
            select(
                'uuid','title','content','us.nickname','min_member','max_member'
            )->join(
                'user as us',
                'us.userid',
                '=',
                'hiking_group.leader'
            )
                ->orderBy('hiking_group.created_at','DESC')
                ->skip($page)
                ->take(10)
                ->get();
        }
    }

    /**
     *
     */
    public function isOwner ($userid, $uuid)
    {
        return HikingGroup::where([
            ['leader',$userid],
            ['uuid',$uuid]
        ])->exists();
    }

    public function groupReg(Array $groupinfo) {
        HikingGroup::insert($groupinfo);
    }

    public function updateGroup($uuid,$title,$content,$min,$max) {
        HikingGroup::where('uuid',$uuid)
            ->update([
                'title'         =>  $title,
                'content'       =>  $content,
                'min_member'    =>  $min,
                'max_member'    =>  $max
            ]);
    }
}