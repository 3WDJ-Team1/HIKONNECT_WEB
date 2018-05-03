<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Group_Member extends Model
{
    protected $table = 'group_member';

    public function memberReg(Array $member_info) {
        Group_Member::insert($member_info);
    }
}
