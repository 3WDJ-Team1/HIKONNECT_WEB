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
namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

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

    public function userReg(Request $request,$userid) {
        User_Profile::insert([
            'uuid'          => '',
            'user'          => $userid,
            'nickname'     => $request->get('nn'),
            'image_path'   => 'https://lorempixe.com/640/400/?66549',
            'phone'         => '010-0000-0000',
            'gender'        => '1',
            'age_group'     => '2',
            'scope'         => '4',
            'created_at'    => Carbon::now()->format('Y-m-d H:i:s'),
            'update_at'     => Carbon::now()->format('Y-m-d H:i:s')
        ]);
    }

    public function userUpdate(Array $userinfo,$id) {
        User_Profile::where('id',$id)->update([$userinfo]);
    }

    public function userDelete($id) {
        User_Profile::where('id',$id)->delete();
    }
}
