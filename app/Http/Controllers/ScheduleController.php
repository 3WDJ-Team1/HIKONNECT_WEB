<?php

namespace App\Http\Controllers;

use App\Models\Hiking_schedule;
use App\Models\schedule_member;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
        $result = Hiking_schedule::select('no','title','leader','content','route','start_date','mnt_id')
            ->get();
        return response()->json($result);
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
            'mnt_id'        => 491303004
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
    public function show($id,$user)
    {
        return $id.$user;
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
        //$id는 schedule_no로 받기
        $this->schedule_member->start_hiking($request->get('userid'),$request->get('uuid'),$id);
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

    public function enter_schedule(Request $request) {
        $member_info = array([
            'userid'                         => $request->get('userid'),
            'hiking_group'                   => $request->get('uuid'),
            'schedule'                       => $request->get('schedule_no'),
            'current_fid'                    => 0,
            'between_before_fid_distance'   => 0,
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

    public function out_schedule(Request $request) {
        $this->schedule_member->out_schedule($request->get('userid'),$request->get('uuid'),$request->get('schedule_no'));
        return response()->json('true');
    }

    public function my_schedule(Request $request) {
        $result = $this->hiking_schedule->my_schedule($request->get('userid'),$request->get('uuid'));
        return response()->json($result);
    }
}