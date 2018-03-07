<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{
    private $model = null;

    public function __construct()
    {
        $this->model = new User();
    }

    public function login() {
        return view('/login');
    }

    public function loginprocess(Request $request)
    {
        $userid = $request->get('idv');
        $userinfo = User::all();
        foreach ($userinfo as $user) {
            if ($user->idv == $request->get('idv') && $user->pwv == $request->get('pwv')) {
                $request->session()->put('login',true);
                $request->session()->put('userid',$userid);
                return response()->json('true');
            }
            else
                continue;
        }
        return response()->json('false');
    }

    public function logout(Request $request) {
        $request->session()->flush('login');
        return redirect()->route('/');
    }

}
