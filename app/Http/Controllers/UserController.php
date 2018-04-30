<?php

namespace App\Http\Controllers;

use App\Models\hiking_plan;
use App\Models\hiking_record;
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
    private $userfilmodel = null;
    private $scope = 0;
    private $gender;
    private $age_group;
    private $uuid;
    private $nickname;

    /**
     * UserController constructor.
     * 
     * @param Request $request 
     */
    public function __construct(Request $request)
    {
        $this->usermodel = new User();
        $this->userfilmodel = new UserProfile();

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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        //UserProfile Picture File Save
        // Storage::put(
        //     'userprofile/' . $id . '.png',
        //     $request->get('imageSrc')
        // );
        // $image_path = 'userprofile/'.$id.'.png';
        // $password = $request->get('pwv');
        // $this->usermodel->userUpdate($password,$id);

        // $user_info = array([
        //     'nickname'  => $request->get('nn'),
        //     'phone'     => $request->get('phone'),
        //     'scope'     => $this->scope,
        //     'gender'    => $this->gender,
        //     'age_group' => $this->age_group,
        //     'image_path'=> $image_path
        // ]);

        // UserProfile::where('user',$id)
        //     ->update([
        //         'nickname'  => $request->get('nn'),
        //         'phone'     => $request->get('phone'),
        //         'scope'     => $this->scope,
        //         'gender'    => $this->gender,
        //         'age_group' => $this->age_group,
        //         'image_path'=> $image_path,
        //         'updated_at'=> Carbon::now()->format('Y-m-d H:i:s')
        //     ]);
        // return response()->json('true');
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
     * @function    showUserData
     * @brief       Get User's Information
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showUserData($id)
    {
        if (hiking_record::where('owner', $id)->count() == 0) {
            $profile_value = array([
                'grade' => '동네 뒷산',
            ]);
            return response()->json($profile_value);
        } else {
            // UserGrade Setting
            $hiking_count = hiking_record::where('uuid', $id)->count();
            if ($hiking_count < 5) {
                $grade = '동네 뒷산';
            } elseif ($hiking_count > 5 && $hiking_count < 10) {
                $grade = '팔공산';
            } elseif ($hiking_count > 10 && $hiking_count < 20) {
                $grade = '한라산';
            } elseif ($hiking_count > 20 && $hiking_count < 50) {
                $grade = '백두산';
            } else {
                $grade = '에베레스트';
            }

            // Total Hiking Time Setting
            $all_time = 0;
            $hiking_time = hiking_record::select(
                DB::raw(
                    'timestampdiff(minute, created_at, updated_at) as HikingTime'
                )
            )->where(
                'owner', 
                $id
            )->get();

            foreach ($hiking_time as $hiking) {
                $all_time += $hiking->HikingTime;
            }

            $hour = intval($all_time / 60);
            $minute = $all_time % 60;
            $all_time = $hour . '시간 ' . $minute . '분';

            // Average Hiking Speed Setting
            $total_speed = 0;
            $row_count = hiking_record::where(
                'owner', 
                $id
            )->count();
            $avg_speed = hiking_record::where(
                'owner', 
                $id
            )->select('avg_speed')
            ->get();
            foreach ($avg_speed as $speed) {
                $total_speed += $speed->avg_speed;
            }
            $avg_speed = $total_speed / $row_count;

            // Recent Hiking Record Setting
            $recent_hiking = hiking_record::where('owner', $id)->select('created_at')->orderBy('created_at')->first();
            $hiking_plan_value = hiking_record::where('owner', $id)->select('hiking_plan')->orderBy('created_at')->first();
            $hiking_plan = $hiking_plan_value->hiking_plan;
            $hiking_group = hiking_plan::leftjoin('hiking_group', 'hiking_plan.hiking_group', '=', 'hiking_group.uuid')
                ->select('hiking_group.name')
                ->where('hiking_plan.uuid', $hiking_plan)
                ->first();
            $hiking_group_name = $hiking_group->name;

            $profile_value = array([
                'grade' => $grade,
                'avg_speed' => intval($avg_speed),
                'hiking_time' => $all_time,
                'recent_hiking' => $recent_hiking,
                'hiking_group_name' => $hiking_group_name
            ]);
        }
        return response()->json($profile_value);
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
    public function graph(Request $request,$id) 
    {
        $year = $request->get('year');
        $month = array();
        for ($i = 1; $i <= 12; $i++) {
            if ($i == 1 || 3 || 5 || 7 || 8 || 10 || 12) {
                $count = hiking_record::where(
                    'owner',
                    $id
                )->where(
                    'created_at',
                    '>=', 
                    $year . '-' . $i . '-01'
                )->where(
                    'created_at',
                    '<=', 
                    $year . '-' . $i . '-30'
                )->count();
            } elseif ($i == 2) {
                $count = hiking_record::where('owner', $id)
                    ->where('created_at', '>=', $year . '-' . $i . '-01')
                    ->where('created_at', '<=', $year . '-' . $i . '-28')
                    ->count();
            } else {
                $count = hiking_record::where(
                    'owner',
                    $id
                )->where(
                    'created_at',
                    '>=', 
                    $year . '-' . $i . '-01'
                )->where(
                    'created_at',
                    '<=', 
                    $year . '-' . $i . '-30'
                )->count();
            }
            $month[$i] = $count;
        }
        return response()->json($month);
    }

    /**
     * Get User's profile data set
     * 
     * @param String $userUuid 
     * 
     * @return Array
     */
    public function getUserProfile(String $userUuid)
    {
        return $this->_userProfile_model->getUserProfile($userUuid);
    }
}