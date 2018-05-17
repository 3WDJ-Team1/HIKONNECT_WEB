<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Model class for Announce
 *
 * @category Model
 * @package  App
 * @author   Sol Song <thdthf159@naver.com>
 * @license  MIT license
 * @link     https://github.com/3WDJ-Team1/HIKONNECT_WEB
 */

class Hiking_schedule extends Model
{
    /**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $table = 'hiking_schedule';

	public function scheduleReg(Array $info) {
	    Hiking_schedule::insert($info);
    }

    public function scheduleUpdate(Array $info,$id) {
	    Hiking_schedule::where('no',$id)->update([
	        'title'      =>  $info[0]['title'],
            'content'    => $info[0]['content'],
            'route'      => $info[0]['route'],
            'mnt_id'     => $info[0]['mnt_id'],
            'start_date' => $info[0]['start_date']
        ]);
    }

    public function my_schedule($userid) {
        return
            Hiking_schedule::select('no','title','leader','content','route','start_date','mnt_id')
            ->where([
                ['schedule_member.userid',$userid]
            ])->join('schedule_member','schedule_member.schedule','=','hiking_schedule.no')->get();
    }
}
