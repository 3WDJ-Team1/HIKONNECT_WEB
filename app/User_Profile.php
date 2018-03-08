<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class User_Profile extends Model
{
    protected $table = 'user_profile';

    public function userProReg(Request $request, $userid, $scope, $gender, $age_group) {
        User_Profile::insert([
            'uuid'           => '',
            'user'           => $userid,
            'nickname'      => $request->get('nn'),
            'image_path'    => 'https://lorempixel.com/640/400/?66549',
            'phone'         => $request->get('phone'),
            'gender'        => $gender,
            'age_group'     => $age_group,
            'scope'         => '4',
            'created_at'    => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at'    => Carbon::now()->format('Y-m-d H:i:s')

        ]);
    }

    public function userUpdate(Array $userinfo,$id) {
        User_Profile::where('id',$id)->update([$userinfo]);
    }

    public function userDelete($id) {
        User_Profile::where('id',$id)->delete();
    }
}
