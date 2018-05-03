<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Group_Member extends Model
{
    protected $table = 'group_member';

    public function get_member_list($uuid, $whether) {
        return Group_Member::select('user.nickname','enter_date')
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
}
