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
            if ($user->id == $request->get('idv'))
                return response()->json('false');
            if ($user->nn == $request->get('nn'))
                return response()->json('nnfalse');
            else
                continue;
        }
        $userinfo = array([
            'uuid'           => '',
            'id'             => $request->get('idv'),
            'password'      => $request->get('pwv'),
            'created_at'    => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at'    => Carbon::now()->format('Y-m-d H:i:s')
        ]);
        $this->usermodel->userReg($userinfo);
        $userid = User::where('id',$request->get('idv'))->pluck('uuid');
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
                $this->gender = 1;
                break;
            case "여자" :
                $this->gender = 2;
                break;
        }
        switch ($request->get('age')) {
            case '10대':
                $this->age_group = 1;
                break;
            case '20대':
                $this->age_group = 2;
                break;
            case '30대':
                $this->age_group = 3;
                break;
            case '40대':
                $this->age_group = 4;
                break;
            case '50대':
                $this->age_group = 5;
                break;
            case '60대 이상':
                $this->age_group = 6;
                break;

        }
        $this->userfilmodel->userProReg($request, $userid, $this->scope, $this->gender, $this->age_group);
        return response()->json($request);
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
