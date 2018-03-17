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
 * @author   bs Kwon <rnjs9957@gmail.com>
 * @license  MIT license
 * @link     https://github.com/3WDJ-Team1/HIKONNECT_WEB
 */
class User extends Model
{
    protected $table = 'user';
    //User Regist
    public function userReg(Request $request) {
        User::insert([
            'uuid'           => '',
            'id'             => $request->get('idv'),
            'password'      => $request->get('pwv'),
            'created_at'    => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at'    => Carbon::now()->format('Y-m-d H:i:s')
        ]);
    }

    //User Update
    public function userUpdate($password,$id) {
        User::where('uuid',$id)->update(['password' => $password]);
    }

    //User Delete
    public function userDelete($id) {
        User::where('id',$id)->delete();
    }
}

class User_Profile extends Model
{
    protected $table = 'user_profile';
    //User_Profile Information Regist
    public function userProReg(Array $userproinfo) {
        User_Profile::insert($userproinfo);
    }

    public function userUpdateinfo($userid) {
        User_Profile::join('user','user.uuid','=','user_profile.user')->select('user_profile.*','user.id')
            ->where('user.id',$userid)->get();
    }

    //User_Profile Infomation Update
    public function userUpdate(Request $request,$id,$gender,$age_group,$scope,$image_path) {
        User_Profile::where('user',$id)->update([
            'nickname'      => $request->get('nn'),
            'phone'         => $request->get('phone'),
            'image_path'    => $image_path,
            'gender'        => $gender,
            'age_group'     => $age_group,
            'scope'         => $scope
            ]);
    }

    //User_Profile Infomation Delete
    public function userDelete($id) {
        User_Profile::where('id',$id)->delete();
    }
}
