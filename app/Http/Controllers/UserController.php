<?php

namespace App\Http\Controllers;

use App\Models\hiking_record;
use App\User;
use App\User_Profile;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    private $usermodel = null;
    private $userfilmodel = null;
    private $scope;
    private $gender;
    private $age_group;
    private $uuid;
    private $nickname;
    public function __construct(Request $request)
    {
        $this->usermodel = new User();
        $this->userfilmodel = new User_Profile();

        //scope 설정
        if ($request->get('phonesc') == true) {
            $this->scope += 100;
        }
        if ($request->get('gendersc') == true) {
            $this->scope += 10;
        }
        if ($request->get('agesc') == true) {
            $this->scope += 1;
        }
        switch ($request->get('scv')) {
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)     //회원가입
    {
        //아이디 닉네임 중복 검사
        $usercheck = User::all();
        foreach ($usercheck as $user) {
            if ($user->idv == $request->get('idv')) {
                return response()->json('false');
            }
            else
                continue;
        }
        $usercheck = User_Profile::all();
        foreach ($usercheck as $user) {
            if ($user->nickname == $request->get('nn'))
                return response()->json('nnfalse');
            else
                continue;
        }
        //user 테이블 insert
        $this->usermodel->userReg($request);
        //가입 시 uuid 가져오기
        $this->uuid = User::where('id',$request->get('idv'))->pluck('uuid');
        //user_profile 테이블에 insert
        $userproinfo = array([
            'uuid'          => '',
            'user'          => $this->uuid[0],
            'nickname'     =>  $request->get('nn'),
            'image_path'   => 'https://lorempixe.com/640/400/?66549',
            'phone'         => $request->get('phone'),
            'gender'        => $this->gender,
            'age_group'     => $this->age_group,
            'scope'         => $this->scope,
            'created_at'    => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at'    => Carbon::now()->format('Y-m-d H:i:s')
        ]);
        $this->userfilmodel->userProReg($userproinfo);
        //true 반환
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
        $image = Storage::get('userprofile/'.$id.'.png');
        return response()->json($image);
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //File Save
        Storage::put('userprofile/'.$id.'.png',$request->get('imageSrc'));
        $image_path = 'userprofile/'.$id.'.png';
        $password = $request->get('pwv');
        $this->usermodel->userUpdate($password,$id);
        $this->userfilmodel->userUpdate($request,$id,$this->gender,$this->age_group,$this->scope,$image_path);
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

    public function showUserData($id) {
        // UserGrade Setting
        $hiking_count = hiking_record::where('uuid',$id)->count();
        $grade = '';
        if ($hiking_count < 5)
            $grade = '동네 뒷산';
        elseif ($hiking_count > 5 && $hiking_count < 10)
            $grade = '팔공산';
        elseif ($hiking_count > 10 && $hiking_count < 20)
            $grade = '한라산';
        elseif ($hiking_count > 20 && $hiking_count < 50)
            $grade = '백두산';
        else
            $grade = '에베레스트';

        // Total Hiking Time Setting
        $startTime = hiking_record::select(
            DB::raw('timestampdiff(minute, created_at, updated_at)'))
            ->where('uuid', '00cbdfed-ec47-3c4d-9459-5bc7b99ea6ba')
            ->get();
        //        $startTime = hiking_record::raw('select timestampdiff(minute, created_at, updated_at) from hiking_record where uuid = "00cbdfed-ec47-3c4d-9459-5bc7b99ea6ba"');

        // Average Hiking Speed Setting
        $avgspeed = hiking_record::where('uuid','00cbdfed-ec47-3c4d-9459-5bc7b99ea6ba')->select('avg_speed')->first();
        $avg = $avgspeed->avg_speed;
        return response()->json($startTime);
    }
}
