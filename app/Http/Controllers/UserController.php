<?php

namespace App\Http\Controllers;

use App\User;
use App\User_Profile;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class UserController extends Controller
{
    private $usermodel = null;
    private $userfilmodel = null;
    private $scope;
    private $gender;
    private $age_group;
    private $userid;
    public function __construct()
    {
        $this->usermodel = new User();
        $this->userfilmodel = new User_Profile();
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
    public function store(Request $request)
    {
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
        $this->usermodel->userReg($request);
        $this->userid = User::where('id',$request->get('idv'))->pluck('uuid');
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
        $userproinfo = array([
            'uuid'          => '',
            'user'          => 'f42f795e-0701-3772-90c9-d1b9e697fb3e',
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
}
