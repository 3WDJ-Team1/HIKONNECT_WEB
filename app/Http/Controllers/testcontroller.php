<?php

namespace App\Http\Controllers;

use App\Models\entry_info;
use App\Models\location_memo;
use App\Models\test;
use App\Models\user_position;
use App\User;
use App\User_Profile;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Mockery\Exception;

class testcontroller extends Controller
{

    private $location_memo;

    public function __construct()
    {
        $this->location_memo = new location_memo();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return "ㅎㅇㅎㅇ";
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
        $user_id    = $request->get('user_id');

        $uuid = User::where('id',$user_id)->select('uuid')->get()[0]['uuid'];
        $hiking_group = entry_info::where('user',$uuid)->select('hiking_group')->get()[0]['hiking_group'];

        location_memo::insert([
            'uuid'          => '',
            'writer'        => $uuid,
            'hiking_group'  => $hiking_group,
            'latitude'      => $request->get('lat'),
            'longitude'     => $request->get('lng'),
            'title'         => $request->get('title'),
            'content'       => $request->get('content'),
            'image_path'    => $request->get('image_path'),
            'created_at'    => $request->get('created_at'),
            'updated_at'    => $request->get('updated_at')
        ]);


        $result = location_memo::where('hiking_group',$hiking_group)->get()->toArray();

        print json_encode($result);
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

    public function get_Memo_Info(Request $request) {
        $uuid = User::where('id',$request->get('id'))->select('uuid')->get()[0]['uuid'];
        $hiking_group = entry_info::where('user',$uuid)->select('hiking_group')->get()[0]['hiking_group'];

        $row = location_memo::where('hiking_group',$hiking_group)->get()->toArray();

        print json_encode($row);
    }

    public function send_image_path(Request $request) {
        $path = location_memo::where('latitude',$request->get('lat'))->
        where('longitude',$request->get('lng'))->get();

        print json_encode($path);
    }
    public function store_send(Request $request) {
        $uuid = User::where('id',$request->get('id'))->select('uuid')->get()[0]['uuid'];
        $hiking_group = entry_info::where('user',$uuid)->select('hiking_group')->get()[0]['hiking_group'];
        /*user_position::insert([
            'uuid'          => '',
            'user'          => $uuid,
            'hiking_group'  => $hiking_group,
            'latitude'      => $request->get('lat'),
            'longitude'     => $request->get('lng')
        ]);*/
        $userid = user_position::where('user',$request->get('id'))->first();
        try{
            if($userid == null) {
                user_position::insert([
                    'uuid'          => '',
                    'user'          => $uuid,
                    'hiking_group'  => $hiking_group,
                    'latitude'      => $request->get('lat'),
                    'longitude'     => $request->get('lng')
                ]);
            }
            else
                throw new Exception("ASdasd");

        }catch (\Exception $e) {
            user_position::where('user',$request->get('id'))->update([
                'latitude'      => $request->get('lat'),
                'longitude'     => $request->get('lng')
            ]);
        }

        $result = user_position::where('hiking_group',$hiking_group)->get()->toArray();
        print json_encode($result);
    }
}
