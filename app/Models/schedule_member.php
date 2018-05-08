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
}