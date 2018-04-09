<?php

namespace App\Http\Controllers;

use App\Models\test;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class testcontroller extends Controller
{

    private $table;

    public function __construct()
    {
        $this->table = new test();
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
        $lat        = $request->get('lat');
        $lng        = $request->get('lng');
        $image      = $request->get('image_path');
        $content    = $request->get('content');
        $location   = array(['latitude' => $lat, 'longitude' => $lng]);
        json_encode($location);

        $writer = User::where('id',$user_id)->select('uuid')->get()[0]['uuid'];


        /*$lm_info = array(['uuid' => '',
            ]);*/

        /*$this->table->testInsert();*/

        $lm_info = array(['writer' => $writer,
            'lat' => $lat,
            'lng' => $lng,
            'image' => $image,
            'content' => $content]);

        print (json_encode($lm_info));
        /*echo "유저아이디는 ".$writer."lat은 ".$lat."이고 lng은".$lng."이다. \n이미지는 ".$image."\n내용은 ".$content;*/
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
