<?php

namespace App\Http\Controllers;

use App\Models\Hiking_schedule;
use App\Models\schedule_member;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * Controller class for Group_Schedule
 *
 * @category Controllers
 * @package  App
 * @author   Sol Song <thdthf159@naver.com>
 * @license  MIT license
 * @link     https://github.com/3WDJ-Team1/HIKONNECT_WEB
 */

class ScheduleController extends Controller
{
    private $hiking_schedule;
    private $schedule_member;

    public function __construct()
    {
        $this->hiking_schedule = new Hiking_schedule();
        $this->schedule_member = new schedule_member();
    }

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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $info = array([
            'title'         => $request->get('tt'),
            'content'       => $request->get('ct'),
            'leader'        => $request->get('owner'),
            'hiking_group'  => $request->get('uuid'),
            'route'         => $request->get('mountP'),
            'created_at'    => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at'    => Carbon::now()->format('Y-m-d H:i:s'),
            'start_date'    => $request->get('stDate'),
            'mnt_id'        => $request->get('mnt_id')
        ]);
        $this->hiking_schedule->scheduleReg($info);
        return response()->json('true');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($uuid)
    {
        $result = array();
        $i = 0;
        $list = json_decode(Hiking_schedule::select('no','title','content','leader','start_date','mnt_id','route')->where('hiking_group',$uuid)->get());
        foreach ($list as $value) {
            $result[$i]['no'] = $value->no;
            $result[$i]['title'] = $value->title;
            $result[$i]['content'] = $value->content;
            $result[$i]['leader'] = $value->leader;
            $result[$i]['mnt_id'] = $value->mnt_id;
            $result[$i]['start_date'] = $value->start_date;
            $result[$i]['route'] = json_decode($value->route);
            $i++;
        }
        return $result;
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
     * @function    enter_schedule
     * @brief       Enter Schedule
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function enter_schedule(Request $request) {
        $member_info = array([
            'userid'                         => $request->get('userid'),
            'hiking_group'                   => $request->get('uuid'),
            'schedule'                       => $request->get('schedule_no'),
            'current_fid'                    => 0,
            'distance'                       => 0,
            'created_at'                     => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at'                     => Carbon::now()->format('Y-m-d H:i:s'),
            'latitude'                       => 0,
            'longitude'                      => 0,
            'avg_speed'                      => 0
        ]);
        $this->schedule_member->enter_schedule($member_info);
        return response()->json('true');
    }

    /**
     * @function    out_schedule
     * @brief       Out of Schedule
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function out_schedule(Request $request) {
        $this->schedule_member->out_schedule($request->get('userid'),$request->get('uuid'),$request->get('schedule_no'));
        return response()->json('true');
    }

    /**
     * @function    my_schedule
     * @brief       My Schedule
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function my_schedule(Request $request) {
        if (schedule_member::where('userid',$request->get('userid'))->exists() == true) {
            $result = array();
            $list = json_decode($this->schedule_member->mySchedule($request->get('userid')));
            $i = 0;
            foreach ($list as $value) {
                $result[$i]['group_title'] = $value->group_title;
                $result[$i]['no'] = $value->no;
                $result[$i]['title'] = $value->title;
                $result[$i]['content'] = $value->content;
                $result[$i]['schedule_leader'] = $value->schedule_leader;
                $result[$i]['uuid'] = $value->uuid;
                $result[$i]['group_leader'] = $value->group_leader;
                $result[$i]['start_date'] = $value->start_date;
                $result[$i]['mnt_name'] = $value->mnt_name;
                $result[$i]['mnt_id'] = $value->mnt_id;
                $result[$i]['route'] = json_decode($value->route);
                $i++;
            }
            return response()->json($result);
        } else {
            return 'false';
        }
    }

    public function makeScheduleList(Request $request) {
        if (Hiking_schedule::where('hiking_schedule.leader',$request->get('userid'))->exists() == true) {
            return response()->json($this->schedule_member->makeScheduleList($request->get('userid')));
        } else {
            return 'false';
        }
    }

    public function hiking_history($userid) {
        return response()->json($this->schedule_member->hiking_history($userid));
    }

    public function reg_ip(Request $request) {
        $schedule   = $request->get('schedule');
        $userid     = $request->get('userid');
        $ip         = $request->get('ip');

        $this->schedule_member->reg_ip($schedule, $userid, $ip);
        return response()->json($schedule.$userid);
    }

    public function schedule_member_list($uuid,$schedule_no) {
        $result = $this->schedule_member->member_list($uuid,$schedule_no);
        return response()->json($result);
    }
}