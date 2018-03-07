<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    private $model = null;
    private $scope;

    public function __construct()
    {
        $this->model = new User();
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
            if ($user->idv == $request->get('idv'))
                return response()->json('false');
            if ($user->nn == $request->get('nn'))
                return response()->json('nnfalse');
            else
                continue;
        }
        $userinfo = array(
            'idv' => $request->get('idv'),
            'pwv' => $request->get('pwv'),
            'nn' => $request->get('nn')
        );
        $this->model->userReg($userinfo);
        if ($request->get('phonesc') == true) {
            $this->scope += 100;
        }
        if ($request->get('gendersc') == true) {
            $this->scope += 10;
        }
        if ($request->get(''))
        $userprofile = array(
            'idv'           => $request->get('idv'),
            'nickname'     => $request->get('nickname'),
            'image_path'   => 'abc',
            'phone'         => $request->get('phone'),
            'gender'        => $request->get('gender'),
            'age_group'     => $request->get('age_group'),
            'scope'         => $this->scope
        );
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
