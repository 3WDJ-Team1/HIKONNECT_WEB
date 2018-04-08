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

use Illuminate\Database\Eloquent\Model;

/**
 * Model class for UserPfoile
 * 
 * @category Model
 * @package  App
 * @author   Sol Song <thdthf159@naver.com>, bs Kwon <rnjs9957@gmail.com>
 * @license  MIT license
 * @link     https://github.com/3WDJ-Team1/HIKONNECT_WEB
 */
class UserProfile extends Model
{
    protected $table = 'user_profile';

    //UserProfile Information Regist
    public function userProReg(Array $userproinfo) 
    {
        UserProfile::insert($userproinfo);
    }

    public function userUpdateinfo($userid) 
    {
        UserProfile::join(
            'user',
            'user.uuid',
            '=',
            'user_profile.user'
        )->select(
            'user_profile.*',
            'user.id'
        )->where(
            'user.id',
            $userid
        )->get();
    }

    //UserProfile Infomation Update
    public function userUpdate(Request $request, $id, $gender, $age_group, $scope,$image_path) 
    {
        UserProfile::where(
            'user',
            $id
        )->update(
            [
            'nickname'      => $request->get('nn'),
            'phone'         => $request->get('phone'),
            'image_path'    => $image_path,
            'gender'        => $gender,
            'age_group'     => $age_group,
            'scope'         => $scope,
            'updated_at'    => Carbon::now()->format('Y-m-d H:i:s')
            ]
        );
    }

    //UserProfile Infomation Delete
    public function userDelete($id) 
    {
        UserProfile::where(
            'id',
            $id
        )->delete();
    }

    /**
     * Get user's profile reference by User's UUID
     * 
     * @param String $userUuid User's UUID
     * 
     * @return Array
     */
    public function getUserProfile(String $userUuid)
    {
        $queryRes = UserProfile::select(
            'user as uuid',
            'nickname as name',
            'gender',
            'phone',
            'image_path as profilePic'
        )->where('user', $userUuid)
        ->get();

        return $queryRes;
    }
}