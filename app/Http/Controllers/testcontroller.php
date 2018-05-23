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
 * Test controller
 *
 * @category Controller
 * @package  App\Http\Controller
 * @author   bs Kwon <rnjs9957@gmail.com>
 * @author   SongSol <address@domain.com>
 * @license  MIT License
 * @link     link
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
        //
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
                    u.nickname as nickname,
                    picture
                FROM location_memo as lm
                JOIN user as u
                ON u.userid = lm.writer
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

        if ($state == 0) { 
            $insertSet['hiking_start'] = date('Y-m-d H:i:s');
        } else if ($state == 1) {
            $insertSet['updated_at'] = date('Y-m-d H:i:s');
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
     * @var Integer $member_no [POST] Unique number of the user.
     *
     * @return Array [
     *                  member_no,  The Unique key of member who is
     *                              participating in schedule.
     *                  nickname,   The members' nickname.
     *                  rank        The ranking which measure by distance
     *                              of hiking from starting point.
     *               ]
     */
    function getScheduleMembers(Request $request)
    {
        $member_no = $request->get('member_no');
        $queryRes = DB::select(
            DB::raw(
                "SELECT 
                    u.userid,
                    member_no,
                    nickname,
                    distance,
                    latitude,
                    longitude,
                    (
                        SELECT count(*) + 1
                        FROM schedule_member
                        WHERE distance > sm.distance
                        AND schedule = (
                            SELECT schedule
                            FROM schedule_member
                            WHERE member_no = '${member_no}'
                        )
                    ) as rank
                FROM schedule_member as sm
                JOIN user as u
                ON u.userid = sm.userid
                WHERE sm.schedule = (
                    SELECT schedule
                    FROM schedule_member as sub_sm
                    WHERE member_no = '${member_no}'
                )
                AND sm.distance IS NOT NULL
                ORDER BY rank;"
            )
        );
        return $queryRes;
    }
    /**
     * Get detail information of the member.
     *
     * @param Request $request .
     *
     * @var String $member_no           [POST] Member's unique number
     *                                  who is participating in schedule.
     *
     * @return Array [
     *                  nickname,       Nickname of the member.
     *                  profile,        Member's profile image.
     *                  distance,       The distance which member hiked.
     *                  hiking_start,   Started time, member was started hiking.
     *                  avg_speed,      Member's average hiking speed.
     *                  rank            The ranking which measure by distance
     *                                  of hiking from starting point.
     *               ]
     */
    public function getMemberDetail(Request $request)
    {
        $member_no = $request->get('member_no');
        $queryRes = DB::select(
            DB::raw(
                "SELECT
                    u.nickname          as nickname,
                    u.profile           as profile,
                    hg.title            as hiking_group,
                    sm.distance         as distance,
                    sm.hiking_start     as hiking_start,
                    sm.avg_speed        as velocity,
                    (
                        SELECT count(*) + 1
                        FROM schedule_member
                        WHERE distance > sm.distance
                        AND schedule = sm.schedule
                    ) as rank
                FROM user as u
                JOIN schedule_member as sm
                ON u.userid = sm.userid
                JOIN hiking_group as hg
                ON hg.uuid = sm.hiking_group
                WHERE sm.member_no = '${member_no}'
                ORDER BY sm.distance;"
            )
        );
        return $queryRes;
    }
    public function getMemberNo(Request $request)
    {
        $user_id = $request->get('user_id');
        $queryRes = DB::table('schedule_member')
            ->select('member_no')
            ->where('userid', $user_id)
            ->get();
        return $queryRes;
    }
}