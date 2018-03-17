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

    public function userReg(Request $request) {
        User::insert([
            'uuid'           => '',
            'id'             => $request->get('idv'),
            'password'      => $request->get('pwv'),
            'created_at'    => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at'    => Carbon::now()->format('Y-m-d H:i:s')
        ]);
    }


    public function userUpdate(Array $userinfo,$id) {
        User::where('id',$id)->update([$userinfo]);
    }

    public function userDelete($id) {
        User::where('id',$id)->delete();
    }
}

class User_Profile extends Model
{
    protected $table = 'user_profile';
    public function userProReg(Array $userproinfo) {
        User_Profile::insert($userproinfo);
    }

    public function userUpdateinfo($userid) {
        User_Profile::join('user','user.uuid','=','user_profile.user')->select('user_profile.*','user.id')
            ->where('user.id',$userid)->get();
    }

    public function userUpdate(Array $userinfo,$id) {
        User_Profile::where('id',$id)->update([$userinfo]);
    }

    public function userDelete($id) {
        User_Profile::where('id',$id)->delete();
    }
}
