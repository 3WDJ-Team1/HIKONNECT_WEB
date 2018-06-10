<?php
namespace App\Models;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use App\Request;
/**
 * Model class for schedule_member
 *
 * @category Model
 * @package  App
 * @author   Sol Song <thdthf159@naver.com>
 * @license  MIT license
 * @link     https://github.com/3WDJ-Team1/HIKONNECT_WEB
 */
class schedule_member extends Model
{
    public $timestamps  = false;
    protected $table    = 'schedule_member';
    
    public function enter_schedule($member_info) {
        schedule_member::insert($member_info);
    }

    public function out_schedule($userid, $uuid) {
        schedule_member::where([
            ['userid',$userid],
            ['hiking_group',$uuid]
        ])->delete();
    }

    public function makeScheduleList($userid) {
        return
            Hiking_schedule::select(
                'hiking_group.title as group_title',
                'hiking_schedule.no',
                'hiking_schedule.title',
                'hiking_schedule.leader',
                'hiking_group.uuid',
                'hiking_schedule.content',
                'hiking_schedule.start_date',
                'hiking_schedule.route',
                'hiking_schedule.mnt_id',
                'mountain.mnt_name'
            )->where('hiking_schedule.leader',$userid)->
            join(
                'hiking_group','hiking_group.uuid','=','hiking_schedule.hiking_group'
            )->
            join(
                'mountain','mountain.mnt_id','=','hiking_schedule.mnt_id'
            )->get();
    }
    public function mySchedule($userid,$state) {
        return
            schedule_member::select(
                'hiking_group.title as group_title',
                'hiking_schedule.no',
                'hiking_schedule.title as schedule_title',
                'hiking_schedule.leader as schedule_leader',
                'hiking_group.uuid',
                'hiking_group.leader as group_leader',
                'hiking_schedule.content',
                'hiking_schedule.start_date',
                'hiking_schedule.route',
                'hiking_schedule.mnt_id',
                'mountain.mnt_name'
            )->where([
                ['schedule_member.userid',$userid],
                ['schedule_member.hiking_state',$state]
            ])
                ->join(
                    'hiking_schedule','hiking_schedule.no','=','schedule_member.schedule'
                )->join(
                    'mountain','mountain.mnt_id','=','hiking_schedule.mnt_id'
                )->join(
                    'hiking_group','hiking_group.uuid','=','hiking_schedule.hiking_group'
                )->orderBy('schedule_member.created_at','DESC')->get();
    }

    public function reg_ip ($schedule, $userid, $ip) {
        schedule_member::where([
            ['schedule','=',$schedule],
            ['userid','=',$userid]
        ])->update(['ip_address' => $ip]);
    }

    public function all_reg_ip ($userid, $ip) {
        schedule_member::where('userid','=',$userid)
            ->update(['ip_address' => $ip]);
    }

    public function member_list($uuid,$schedule_no) {
        return schedule_member::select('user.userid','user.nickname','user.gender','user.age_group','user.scope','user.phone','user.grade')->where([
            ['hiking_group',$uuid],
            ['schedule',$schedule_no]
        ])->join('user','user.userid','=','schedule_member.userid')
            ->orderBy('schedule_member.created_at','DESC')->get();
    }

    public function hiking_count($userid) {
        return
            schedule_member::where([
                ['userid',$userid],
                ['hiking_state',2]
            ])->count();
    }

    public function schedule_hiking_member_list($uuid, $schedule_no) {
        return
            schedule_member::select('schedule_member.member_no','user.nickname','schedule_member.latitude','schedule_member.longitude')->where([
                ['schedule_member.hiking_group',$uuid],
                ['schedule_member.schedule',$schedule_no],
                ['schedule_member.hiking_state',1]
            ])->join('user','user.userid','=','schedule_member.userid')->orderBy('schedule_member.created_at','DESC')->get();
    }
}