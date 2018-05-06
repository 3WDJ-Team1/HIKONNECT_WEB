<?php

namespace App\Http\Controllers;

use App\Models\hiking_plan;
use App\Models\hiking_record;
use App\Models\schedule_member;
use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Mockery\Exception;

/**
 * Controller class for User's Information
 *
 * @category Controllers
 * @package  App
 * @author   Sol Song <thdthf159@naver.com>
 * @license  MIT license
 * @link     https://github.com/3WDJ-Team1/HIKONNECT_WEB
 */

class UserController extends Controller
{
    /**
     * Aq
     * 
     * @var Integer   scope       User's Open Scope
     * @var Integer   gender      User's Gender
     * @var Integer   age_group   User's Age Group
     * @var String    uuid        User's Primary Key Value
     * @var nickname  nickname    User's Nickname
     */

    private $usermodel = null;
    private $scope = 0;
    private $gender;
    private $age_group;

    /**
     * UserController constructor.
     * 
     * @param Request $request 
     */
    public function __construct(Request $request)
    {
        $this->usermodel = new User();

        //Scope Setting
        if ($request->get('phonesc') == true) {
            $this->scope += 100;
        }

        if ($request->get('gendersc') == true) {
            $this->scope += 10;
        }

        if ($request->get('agesc') == true) {
            $this->scope += 1;
        }

        switch ($request->get('groupsc')) {
        case 'all':
            $this->scope += 10000;
            break;
        case 'group':
            $this->scope += 1000;
            break;
        }

        switch ($request->get('gender')) {
        case '남자' :
            $this->gender = 0;
            break;
        case "여자" :
            $this->gender = 1;
            break;
        }

        switch ($request->get('age')) {
        case '10대':
            $this->age_group = 10;
            break;
        case '20대':
            $this->age_group = 20;
            break;
        case '30대':
            $this->age_group = 30;
            break;
        case '40대':
            $this->age_group = 40;
            break;
        case '50대':
            $this->age_group = 50;
            break;
        case '60대 이상':
            $this->age_group = 60;
            break;
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('layouts/app');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * @function    store
     * @brief       User Regist
     * 
     * @param \Illuminate\Http\Request $request 
     * 
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (User::where('userid',$request->get('idv'))->exists() == true) {
            return response()->json('idfalse');
        }
        else if (User::where('nickname',$request->get('nn'))->exists() == true) {
            return response()->json('nnfalse');
        }
        else {
            //user table insert
            $userinfo = array([
                'userid'        => $request->get('idv'),
                'password'      => $request->get('pwv'),
                'nickname'     =>  $request->get('nn'),
                'gender'        => $this->gender,
                'age_group'     => $this->age_group,
                'scope'         => $this->scope,
                'profile'       => 'https://lorempixel.com/640/400/?66549',
                'phone'         => $request->get('phone'),
                'rank'          => '동네 뒷산',
                'created_at'    => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at'    => Carbon::now()->format('Y-m-d H:i:s')
            ]);
            $this->usermodel->userReg($userinfo);
            return response()->json('true');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $result               = $this->usermodel->userInfo($id);
        $distance             = 0;
        $total_hiking_time    = 0;
        $hour                 = 0;
        $minute               = 0;
        $second               = 0;

        for($i = 0; $i < count($result); $i++) {
            $distance += $result[$i]['distance'];
        }

        for($i = 0; $i < count($result); $i++) {
            $total_hiking_time = date_diff(date_create($result[$i]['updated_at']),date_create($result[$i]['start_date']));
            $hour             += $total_hiking_time->days * 24 + $total_hiking_time->h;
            $minute           += $total_hiking_time->i;
            $second           += $total_hiking_time->s;
        }

        $total_hiking_time = array(
            'hour'      =>  $hour + sprintf('%d',$minute / 60),
            'minute'    =>  $minute % 60 + sprintf('%d', $second / 60),
            'second'    =>  $second % 60
        );
        $result['total_distance']       = $distance;
        $result['total_hiking_time']    = $total_hiking_time;
        return response()->json($result);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * @function    update
     * @brief       User Information Update
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->usermodel->userUpdate($request,$this->age_group,$this->scope,$id);
        return response()->json('true');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * @funtion     graph
     * @brief       Get Graph's Information
     * 
     * @param \Illuminate\Http\Request $request 
     * @param int                      $id 
     * 
     * @return \Illuminate\Http\Response
     */
    public function graph(Request $request)
    {
        $year = $request->get('year');
        $month = array();
        for ($i = 1; $i <= 12; $i++) {
            if ($i == 1 || 3 || 5 || 7 || 8 || 10 || 12) {
                $count = schedule_member::where(
                    'userid',
                    $request->get('userid')
                )->where([
                    ['updated_at',
                    '>=',
                    $year . '-' . $i . '-01'],
                    ['hiking_state',2],
                    ['updated_at',
                        '<=',
                        $year . '-' . $i . '-31']
                ])->count();
            } elseif ($i == 2) {
                $count = schedule_member::where(
                    'userid',
                    $request->get('userid')
                )->where([
                    ['updated_at',
                        '>=',
                        $year . '-' . $i . '-01'],
                    ['hiking_state',2],
                    ['updated_at',
                        '<=',
                        $year . '-' . $i . '-28']
                ])->count();
            } else {
                $count = schedule_member::where(
                    'userid',
                    $request->get('userid')
                )->where([
                    ['updated_at',
                        '>=',
                        $year . '-' . $i . '-01'],
                    ['hiking_state',2],
                    ['updated_at',
                        '<=',
                        $year . '-' . $i . '-30']
                ])->count();
            }
            $month[$i] = $count;
        }
        return response()->json($month);
    }
}