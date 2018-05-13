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
    protected $table = 'schedule_member';

    public function enter_schedule($member_info) {
        schedule_member::insert($member_info);
    }

    public function out_schedule($userid, $uuid, $schedule_no) {
        schedule_member::where([
            ['userid',$userid],
            ['hiking_group',$uuid],
            ['schedule',$schedule_no]
        ])->delete();
    }

    public function start_hiking($userid, $uuid, $schedule_no) {
        schedule_member::where([
            ['userid', $userid],
            ['hiking_group', $uuid],
            ['schedule', $schedule_no]
        ])->update(
            ['hiking_state' => 1]
        );
    }

    public function hiking_history($userid) {
        return
            schedule_member::select(
                'schedule_member.avg_speed',
                'schedule_member.updated_at as arrive_time',
                'hs.start_date',
                'hs.title as schedule_title',
                'hs.route',
                'hs.mnt_id',
                'mountain.mnt_name',
                'user.nickname as schedule_leader',
                'hg.title as group_title',
                'hg.leader as group_leader',
                'hg.uuid'
            )->where([
                ['schedule_member.userid',$userid],
                ['schedule_member.hiking_state',2]
            ])->join(
                'hiking_schedule as hs','hs.no','=','schedule_member.schedule'
            )->join(
                'mountain','hs.mnt_id','=','mountain.mnt_id'
            )->join(
                'user','user.userid','=','hs.leader'
            )->join(
                'hiking_group as hg','hg.uuid','=','hs.hiking_group'
            )->get();
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

    public function mySchedule($userid) {
        return
            schedule_member::select(
                'hiking_group.title as group_title',
                'hiking_schedule.no',
                'hiking_schedule.title',
                'hiking_schedule.leader as schedule_leader',
                'hiking_group.uuid',
                'hiking_group.leader as group_leader',
                'hiking_schedule.content',
                'hiking_schedule.start_date',
                'hiking_schedule.route',
                'hiking_schedule.mnt_id',
                'mountain.mnt_name'
            )->where('schedule_member.userid',$userid)
                ->join(
                    'hiking_schedule','hiking_schedule.no','=','schedule_member.schedule'
                )->join(
                    'mountain','mountain.mnt_id','=','hiking_schedule.mnt_id'
                )->join(
                    'hiking_group','hiking_group.uuid','=','hiking_schedule.hiking_group'
                )->get();
    }

    public function reg_ip ($schedule, $userid, $ip) {
        schedule_member::where([
            ['schedule','=',$schedule],
            ['userid','=',$userid]
        ])->update(['ip_address' => $ip]);
    }
}