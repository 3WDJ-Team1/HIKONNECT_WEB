<?php

namespace App\Http\Controllers;

use App\Models\entry_info;
use App\Models\LocationMemo;
use App\Models\test;
use DB;
// use App\User;
// use App\User_Profile;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class testcontroller extends Controller
{

    private $location_memo;

    public function __construct()
    {
        $this->location_memo = new LocationMemo();
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

        $uuid = DB::table('user')->where('id',$user_id)->select('uuid')->get()[0]->uuid;
        $hiking_group = DB::table('entry_info')->where('user',$uuid)->select('hiking_group')->get()[0]->hiking_group;

        DB::table('location_memo')->insert([
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
        
        echo $uuid;
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
    
    /**
     * Store location memo.
     * 
     * @param Request $request .
     * 
     * @var String $user_id     User ID.
     * @var String $latitude    User latitude.
     * @var String $longitude   User longitude.
     * @var String $title       Memo title.
     * @var String $content     Memo contents.
     * @var String $image_path  Memo image file path.
     * @var String $created_at  Created time.
     * @var String $updated_at  Updated time.
     * 
     * @return ??
     */
    public function storeLocationMemo(Request $request)
    {
        $member_no  = $request->get('member_no');
        $latitude   = $request->get('lat');
        $longitude  = $request->get('lng');
        $title      = $request->get('title');
        $content    = $request->get('content');
        $image_path = $request->get('image_path');
        $created_at = date("Y-m-d H:i:s");
        $updated_at = date("Y-m-d H:i:s");

        $schedule_member = DB::table('schedule_member')
            ->select(
                'schedule', 
                'hiking_group', 
                'userid'
            )->where('member_no', $member_no)
            ->get();

        $queryRes = DB::table('location_memo')
        ->insert(
            [
                'schedule_no'   => $schedule_member->get(0)->schedule,
                'hiking_group'  => $schedule_member->get(0)->hiking_group,
                'title'         => $title,
                'content'       => $content,
                'writer'        => $schedule_member->get(0)->userid,
                'picture'       => $image_path,
                'created_at'    => $created_at,
                'updated_at'    => $updated_at,
                'latitude'      => $latitude,
                'longitude'     => $longitude
            ]
        );

        return $queryRes ? 'ture' : 'false';
    }

    /**
     * Get detail information of location memo.
     * 
     * @param Request $request .
     * 
     * @var Integer $location_no [POST] location no.
     * 
     * @return Array Detail information of location memo.
     *               [
     *                  title,          Memo's title.
     *                  content,        Memo's contents.
     *                  writer,         Memo's writer.
     *                  picture        Stored picture directory path.
     *               ]
     */
    public function getLocationMemoDetail(Request $request) 
    {
        $location_no = $request->get('location_no');

        $queryRes = DB::select(
            DB::raw(
                "SELECT
                    title,
                    content,
                    writer,
                    picture
                FROM location_memo
                WHERE no = ${location_no};"
            )
        );

        return $queryRes;
    }

    /**
     * Initialize or update data of user paricapating in schedule.
     * 
     * @param Request $request .
     * 
     * @var Integer $user_id [POST] User's ID.
     * @var Double  $lat     [POST] User's latitude.
     * @var Double  $lng     [POST] User's longitude.
     * 
     * @return JSON {
     *                  "members": {
     *                      member_no, 
     *                      latitude, 
     *                      longitude, 
     *                  },
     *                  "location_memos": {
     *                      no,
     *                      latitude,
     *                      longitude
     *                  }
     *              }
     */
    public function updateScheduleMember(Request $request)
    {
        $member_no      = $request->get('member_no');
        $lat            = $request->get('latitude');
        $lng            = $request->get('longitude');
        $distance       = $request->get('distance');
        $avg_speed      = $request->get('velocity');

        $arr_for_update = array();

        if ($lat && $lng) {
            $arr_for_update['latitude'] = $lat;
            $arr_for_update['longitude'] = $lng;
        }
        if ($distance) {
            $arr_for_update['distance'] = $distance;
        }
        if ($avg_speed) {
            $arr_for_update['avg_speed'] = $avg_speed;
        }

        $user_id_check = schedule_member::where('member_no', $member_no)
            ->get();

        schedule_member::where('member_no', $member_no)
        ->update($arr_for_update);

        // Get the locations of members who participate in the same schedule.
        $pos_members = DB::select(
            DB::raw(
                "SELECT
                    member_no,
                    latitude,
                    longitude,
                    userid
                FROM schedule_member
                WHERE schedule = (
                    SELECT schedule
                    FROM schedule_member
                    WHERE member_no = '${member_no}'
                );"
            )
        );

        $pos_location_memo = DB::select(
            DB::raw(
                "SELECT
                    no,
                    latitude,
                    longitude 
                FROM location_memo
                WHERE schedule_no = (
                    SELECT schedule
                    FROM schedule_member
                    WHERE member_no = '${member_no}'
                )"
            )
        );
        
        $httpResponse = [
            'members'           => $pos_members,
            'location_memos'    => $pos_location_memo
        ];

        return $httpResponse;
    }

    /**
     * Get current FID(Field ID) from data server(hikonnect.ga:3000).
     * 
     * @param Integer $mntCode code which key of target mountain.
     * @param Array   $fidSet  Field ID set which user has been 
     *                         participating schedule.
     * @param Double  $lat     User's latitude.
     * @param Double  $lng     User's longitude.
     * 
     * @return String Field ID which user was located in specific mountain.
     */
    function getCurrentFID($mntCode, $fidSet, $lat, $lng)
    {
        $mntCode    = intval($mntCode);
        $lat        = doubleval($lat);
        $lng        = doubleval($lng);

        try {
            $client = new Client(); // GuzzleHttp\Client
            $result = $client->get(
                '172.26.2.38:3000/mountain/getCurrentFID', 
                [
                    'query' => [
                        'mntCode'   => $mntCode,
                        'fidSet'    => $fidSet,
                        'lat'       => $lat,
                        'lng'       => $lng
                    ]
                ]
            );
        } catch (GuzzleException $e) {
            return "Http Error occured.";
        }

        // var_dump($post_data);

        echo json_encode($post_data);
    }

    public function send_image_path(Request $request) {
        $path = location_memo::where('latitude',$request->get('lat'))->
        where('longitude',$request->get('lng'))->get();

        print json_encode($path);
    }
}
