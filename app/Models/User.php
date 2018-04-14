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
    public function userReg(Request $request) 
    {
        User::insert(
            [
                'uuid'           => '',
                'id'             => $request->get('idv'),
                'password'      => $request->get('pwv'),
                'created_at'    => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at'    => Carbon::now()->format('Y-m-d H:i:s')
            ]
        );
    }

    //User Update
    public function userUpdate($password,$id) 
    {
        User::where('uuid',$id)
            ->update([
                'password'      => $password,
                'updated_at'    => Carbon::now()->format('Y-m-d H:i:s')]);
    }

    //User Delete
    public function userDelete($id) 
    {
        User::where(
            'id',
            $id
        )->delete();
    }
}