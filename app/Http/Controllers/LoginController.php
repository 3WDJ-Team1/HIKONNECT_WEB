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
     * @funtion     loginprocess
     * @brief       Process of Login
     *
     * @param \Illuminate\Http\Request $request
     *         string idv
     *         string pwv
     *
     * @return If login success return 'true'
     *          if login false return 'false','pwfalse'
     *
     */
    public function loginprocess(Request $request)
    {
        //Login
        try {
            $userinfo = User::where('userid', $request->get('idv'))->first();
            if ($userinfo == false) {
                throw new Exception('존재하지 않는 ID');
            }
        } catch (\Exception $e) {
            return response()->json('false');
        }
        if ($userinfo->password == $request->get('pwv')) {
            $sessionVal = User::where('userid',$request->get('idv'))->select(
                'userid','nickname','gender','age_group','scope','profile','phone','password','grade','created_at'
            )->first();
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
        return var_dump($user);
    }
    /**
     * @funtion     login_app
     * @brief       Process of Login to App
     *
     * @param \Illuminate\Http\Request $request
     *         string id
     *         string pw
     *
     * @return \Illuminate\Http\JsonResponse
     *
     */
    public function login_app(Request $request) {
        $userinfo = User::where('userid', $request->get('id'))->first();
        if ($userinfo == false)
            echo "false";
        else {
            if($userinfo->password == $request->get('pw'))
                echo "true";
        }
    }
}