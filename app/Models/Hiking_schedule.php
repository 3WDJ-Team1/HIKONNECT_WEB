<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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

    public function my_schedule($userid,$uuid) {
        return
            Hiking_schedule::select('no','title','leader','content','route','start_date','mnt_id')
            ->where([
                ['schedule_member.userid',$userid],
                ['schedule_member.hiking_group',$uuid]
            ])->join('schedule_member','schedule_member.schedule','=','hiking_schedule.no')->get();
    }
}
