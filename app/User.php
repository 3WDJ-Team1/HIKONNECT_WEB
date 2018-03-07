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
    protected $table = 'item';
    public $timestamps = false;

    public function userReg(Array $userinfo) {
        User::insert($userinfo);
    }

    public function userUpdate(Array $userinfo,$id) {
        User::where('id',$id)->update([$userinfo]);
    }

    public function userDelete($id) {
        User::where('id',$id)->delete();
    }
}
