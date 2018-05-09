<?php
/** 
 * Test controller
 * 
 * PHP version 7.0
 * 
 * @category Controller
 * @package  App\Http\Controllers
 * @author   SongSol <address@email.com>
 * @author   bs Kwon <rnjs9957@gmail.com>
 * @license  MIT License
 * @link     n
 */
namespace App\Http\Controllers;

use DB;
use App\Models\entry_info;
use App\Models\location_memo;
use App\Models\test;
use App\Models\User;
use App\Models\User_Profile;
use App\Models\schedule_member;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;

/**
 * 
 */
class testcontroller extends Controller
{

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
     * @param \Illuminate\Http\Request $request 
     * 
     * @return \Illuminate\Http\Response 
     */
    public function store(Request $request)
    {
        $user_id    = $request->get('user_id');
        $latitude   = $request->get('lat');
        $longitude  = $request->get('lng');
        $title      = $request->get('title');
        $content    = $request->get('content');
        $image_path = $request->get('image_path');
        $created_at = $request->get('created_at');
        $updated_at = $request->get('updated_at');

        $schedule_member = DB::table('schedule_member')
            ->select('schedule', 'hiking_group')
            ->where('userid', $user_id)
            ->get();

        $queryRes = DB::table('location_memo')
        ->insert(
            [
                'schedule_no'   => $schedule_member->get(0)->schedule,
                'hiking_group'  => $schedule_member->get(0)->hiking_group,
                'title'         => $title,
                'content'       => $content,
                'writer'        => $user_id,
                'picture'       => $image_path,
                'created_at'    => $created_at,
                'updated_at'    => $updated_at,
                'latitude'      => $latitude,
                'longitude'     => $longitude
            ]
        );
    }

    /**
     * Display the specified resource.
     *
     * @param int $id 
     * 
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id 
     * 
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request 
     * @param int                      $id 
     * 
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id 
     * 
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Get detail information of location memo.
     * 
     * @param Request $request .
     * 
     * @var Integer $user_id [POST] User's ID.
     * 
     * @return Array Detail information of location memo.
     *               [
     *                  no,             Locaiton memo identification value.
     *                  schedule_no,    Schedule identification value.
     *                  hiking_group,   Hiking group UUID.
     *                  title,          Memo's title.
     *                  content,        Memo's contents.
     *                  writer,         Memo's writer.
     *                  picture,        Stored picture directory path.
     *                  created_at,
     *                  updated_at,
     *                  latitude,
     *                  longitude
     *               ]
     */
    public function getMemoInfo(Request $request) 
    {
        $user_id = $request->get('id');

        $queryRes = DB::select(
            DB::raw(
                '
                    SELECT * 
                    FROM location_memo as lm
                    WHERE lm.schedule_no = (
                        SELECT sm.schedule
                        FROM schedule_member as sm
                        WHERE userid = "admin"
                        GROUP BY sm.schedule
                    );
                '
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
     * @return Array [userid, latitude, longitude, avg_speed, current_fid, distance]
     */
    public function updateScheduleMember(Request $request)
    {
        $user_id    = $request->get('id');
        $lat        = $request->get('latitude');
        $lng        = $request->get('longitude');

        $user_id_check = schedule_member::where('userid', $user_id)
            ->get();

        schedule_member::where('userid', $user_id)
        ->update(
            [
                'latitude'          => $lat,
                'longitude'         => $lng
            ]
        );

        // 10초 마다 디바이스에 전달 할 데이터.
        /* schedule_member::where('userid', $user_id)
         ->update(
             [
                 'latitude'          => $lat,
                 'longitude'         => $lng,
                 'current_fid'       => $current_fid,
                 'avg_speed'         => $avg_speed,
                 'distance'          => $distance
             ]
         ); */

        $result = schedule_member::select(
            'userid',
            'latitude',
            'longitude',
            'current_fid',
            'avg_speed',
            'distance'
        )->get();

        return $result;
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

        return $result->getBody()->getContents();
    }

    /**
     * Update user's hiking status.
     * 
     * @param Request $request 
     * 
     * @var Integer $member_no [POST] Reference Key which participating user.
     * @var Integer $state     [POST] Status flag.
     *                             (0: End hiking, 1: Start hiking, 2: Start rescue).
     * 
     * @return String true/false
     */
    function updateHikingState(Request $request)
    {
        $member_no  = $request->get('member_no');
        $state      = $request->get('state');

        $insertSet = [
            'hiking_state' => $state
        ];

        if ($state == 1) {
            $insertSet['hiking_start'] = date('Y-m-d H:i:s');
        }

        DB::table('schedule_member')
            ->where('member_no', $member_no)
            ->update($insertSet);
    }

    /**
     * Get member list which user is participating in schedule.
     * 
     * @param Request $request .
     * 
     * @var Integer $user_id [POST] User's ID.
     * 
     * @return Array [userid]
     */
    function getScheduleMember(Request $request)
    {
        $user_id = $request->get('user_id');

        $queryRes = DB::select(
            DB::raw(
                "
                    SELECT userid
                    FROM schedule_member
                    WHERE schedule = (
                        SELECT schedule
                        FROM schedule_member
                        WHERE userid = '${user_id}'
                    );
                "
            )
        );

        return $queryRes;
    }


}
