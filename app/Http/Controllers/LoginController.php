<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Controllers\Controller;
use Mockery\Exception;
use Socialite;

/**
 * Controller class for Login
 *
 * @category Controllers
 * @package  App
 * @author   Sol Song <thdthf159@naver.com>
 * @license  MIT license
 * @link     https://github.com/3WDJ-Team1/HIKONNECT_WEB
 */

class LoginController extends Controller
{
    private $model = null;

    /**
     * LoginController constructor.
     */
    public function __construct()
    {
        $this->model = new User();
    }

    public function login()
    {
        return view('/login');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function loginprocess(Request $request)
    {
        //Login
        try {
            $userinfo = User::where('id', $request->get('idv'))->first();
            if ($userinfo == false) {
                throw new Exception('존재하지 않는 ID');
            }
        } catch (\Exception $e) {
            return response()->json('false');
        }
        if ($userinfo->password == $request->get('pwv')) {
            $sessionVal = User::join(
                'user_profile', 
                'user_profile.user', 
                '=', 
                'user.uuid'
            )->select(
                'user_profile.nickname', 
                'user_profile.image_path', 
                'user_profile.phone',
                'user_profile.gender', 
                'user_profile.age_group', 
                'user_profile.scope', 
                'user.uuid', 
                'user.password'
            )->where(
                'id', 
                $request->get('idv')
            )->get();
            
            return response()->json($sessionVal);
        } else {
            return response()->json('pwfalse');
        }
    }

    public function redirectToProvider($providerName)
    {
        if ($providerName == "line") {
            return Socialite::with('line')->redirect();
        }
    }

    public function handleProviderCallback($providerName)
    {
        if ($providerName == "line") {
            $user = Socialite::with('line')->user();
        }

        return $user;
    }
}
