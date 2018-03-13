<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Http\Controllers\Controller;
use Mockery\Exception;

class LoginController extends Controller
{
    private $model = null;

    public function __construct()
    {
        $this->model = new User();
    }

    public function login()
    {
        return view('/login');
    }

    public function loginprocess(Request $request)
    {
        //Login
        try {
            $userinfo = User::where('id', $request->get('idv'))->first();
            if ($userinfo == false)
                throw new Exception('존재하지 않는 ID');
        } catch (\Exception $e) {
            return response()->json('false');
        }
        if ($userinfo->password == $request->get('pwv')) {
            $sessionVal = User::join('user_profile', 'user_profile.user', '=', 'user.uuid')->select('user_profile.nickname', 'user_profile.image_path', 'user_profile.phone',
                'user_profile.gender', 'user_profile.age_group', 'user_profile.scope', 'user.uuid', 'user.password')
                ->where('id', $request->get('idv'))->get();
            return response()->json($sessionVal);
           }
        else
            return response()->json('pwfalse');
    }
}
