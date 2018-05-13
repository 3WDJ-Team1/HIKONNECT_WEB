<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Model class for Announce
 *
 * @category Model
 * @package  App
 * @author   Sol Song <thdthf159@naver.com>
 * @license  MIT license
 * @link     https://github.com/3WDJ-Team1/HIKONNECT_WEB
 */

class Group_Member extends Model
{
    protected $table = 'group_member';

    public function get_member_list($uuid, $whether) {
        return Group_Member::select('user.userid','user.nickname','user.phone','user.age_group',
            'user.gender','user.scope','user.profile','user.grade','enter_date')
            ->where([
            ['hiking_group', $uuid],
            ['enter_whether', $whether]
            ])->join('user','user.userid','=','group_member.userid')->get();
    }

    public function memberReg(Array $member_info) {
        Group_Member::insert($member_info);
    }

    public function checkMember($userid,$uuid) {
        return Group_Member::where([
            ['hiking_group',$uuid],
            ['userid',$userid]
        ])->exists();
    }

    public function accept_member($id,$uuid) {
        Group_Member::where([
            ['userid',$id],
            ['hiking_group',$uuid]
        ])->update(['enter_whether' => 1]);
    }

    public function delete_member($id,$uuid) {
        Group_Member::where([
            ['userid',$id],
            ['hiking_group',$uuid]
        ])->delete();
    }

    public function my_group($userid) {
        return
            Group_Member::select('hiking_group.uuid','hiking_group.title','user.nickname','hiking_group.content',
                'hiking_group.min_member','hiking_group.max_member')
                ->where('group_member.userid',$userid)
                ->join('hiking_group','hiking_group.uuid','=','group_member.hiking_group')
                ->join('user','user.userid','=','group_member.userid')->get();
    }
}
