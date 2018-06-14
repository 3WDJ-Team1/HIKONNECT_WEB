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
use App\Http\Controllers\UserController;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use PhpParser\Node\Scalar\String_;
/**
 * Model class for User
 *
 * @category Model
 * @package  App
 * @author   Sol Song <thdthf159@naver.com>
 * @license  MIT license
 * @link     https://github.com/3WDJ-Team1/HIKONNECT_WEB
 */
class User extends Model
{
    protected $table = 'user';

    //User Regist
    public function userReg(Array $userinfo)
    {
        User::insert(
            $userinfo
        );
    }
    //User Update
    public function userUpdate($password,$nickname,$phone,$gender,$age_group,$scope, $userid)
    {
        User::where('userid',$userid)
            ->update([
                'password'  => $password,
                'nickname'  => $nickname,
                'phone'     => $phone,
                'gender'    => $gender,
                'age_group' => $age_group,
                'scope'     => $scope
            ]);
    }
    //User Delete
    public function userDelete($id)
    {
        User::where(
            'id',
            $id
        )->delete();
    }
    public function userInfo($userid) {
        return
            User::select(
                'user.nickname','user.profile','user.grade','schedule_member.distance','schedule_member.updated_at','hiking_schedule.start_date'
            )->join(
                'schedule_member','schedule_member.userid','=','user.userid'
            )->join(
                'hiking_schedule','hiking_schedule.no','=','schedule_member.schedule'
            )->where([
                    ['user.userid',$userid],
                    ['schedule_member.hiking_state',2]
                ]
            )->get();
    }
    public function user_profile_info($userid) {
        return
            User::where('userid',$userid)->get();
    }
}