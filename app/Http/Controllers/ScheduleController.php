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
            'leader'        => $request->get('leader'),
            'hiking_group'  => $request->get('uuid'),
            'route'         => json_encode($request->get('mountP')),
            'created_at'    => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at'    => Carbon::now()->format('Y-m-d H:i:s'),
            'start_date'    => $request->get('stDate'),
            'mnt_id'        => $request->get('mnt_id')
        ]);
        $this->hiking_schedule->scheduleReg($info);

        //leader enter schedule
        $schedule_no = Hiking_schedule::select('no')->orderBy('created_at','DESC')->first()['no'];
        $member_info = array([
            'userid'                         => $request->get('leader'),
            'hiking_group'                   => $request->get('uuid'),
            'schedule'                       => $schedule_no,
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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($uuid)
    {
        $result = array();
        $i = 0;
        $list = json_decode(Hiking_schedule::select(
            'no','title','content','leader','start_date','hiking_schedule.mnt_id','route','mountain.mnt_name'
        )->where([
            ['hiking_group',$uuid],
            ['start_date','>',Carbon::now()->format('Y-m-d H:i:s')]
        ])->join(
            'mountain','hiking_schedule.mnt_id','=','mountain.mnt_id'
        )->orderBy('created_at','DESC')->get());
        foreach ($list as $value) {
            $result[$i]['no'] = $value->no;
            $result[$i]['title'] = $value->title;
            $result[$i]['content'] = $value->content;
            $result[$i]['leader'] = $value->leader;
            $result[$i]['mnt_id'] = $value->mnt_id;
            $result[$i]['start_date'] = $value->start_date;
            $result[$i]['route'] = json_decode($value->route);
            $result[$i]['mnt_name'] = $value->mnt_name;
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
        $info = array([
            'title'         => $request->get('title'),
            'content'       => $request->get('content'),
            'route'         => $request->get('route'),
            'updated_at'    => Carbon::now()->format('Y-m-d H:i:s'),
            'start_date'    => $request->get('stDate'),
            'mnt_id'        => $request->get('mnt_id')
        ]);
        $this->hiking_schedule->scheduleUpdate($info,$id);
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
        $this->hiking_schedule->where('no', $id)->delete();
        return response()->json('true');
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
            $list = json_decode($this->schedule_member->mySchedule($request->get('userid'),0));
            $i = 0;
            foreach ($list as $value) {
                $result[$i]['group_title'] = $value->group_title;
                $result[$i]['no'] = $value->no;
                $result[$i]['title'] = $value->schedule_title;
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
    public function hiking_history($userid) {
        if (schedule_member::where('userid',$userid)->exists() == true) {
            $result = array();
            $list = json_decode($this->schedule_member->mySchedule($userid,2));
            $i = 0;
            foreach ($list as $value) {
                $result[$i]['group_title'] = $value->group_title;
                $result[$i]['no'] = $value->no;
                $result[$i]['title'] = $value->schedule_title;
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
    public function reg_ip(Request $request) {
        $schedule   = $request->get('schedule');
        $userid     = $request->get('userid');
        $ip         = $request->get('ip');
        $this->schedule_member->reg_ip($schedule, $userid, $ip);
        return 'true';
    }

    public function get_ip($schedule_no) {
        return schedule_member::select('userid','ip_address')->where('schedule',$schedule_no)->get();
    }

    public function all_reg_ip(Request $request) {
        $this->schedule_member->all_reg_ip($request->get('userid'),$request->get('ip'));
        return 'true';
    }

    public function schedule_member_list($uuid,$schedule_no) {
        $result = $this->schedule_member->member_list($uuid,$schedule_no);
        return response()->json($result);
    }

    public function hiking_count($userid) {
        return response()->json($this->schedule_member->hiking_count($userid));
    }

    public function check_schedule($userid, $no) {
        $result = '';
        if (Hiking_schedule::where([
                ['leader',$userid],
                ['no',$no]
            ])->exists() == true)
            $result = 'owner';
        else if (schedule_member::where([
                ['userid',$userid],
                ['schedule',$no]
            ])->exists() == true)
            $result = 'member';
        else if ((schedule_member::where([
                ['userid',$userid],
                ['schedule',$no]
            ])->exists() == false))
            $result = 'guest';
        return json_encode($result);
    }

    public function schedule_hiking_member_list($uuid, $schedule_no) {
        return response()->json($this->schedule_member->schedule_hiking_member_list($uuid,$schedule_no));
    }
}