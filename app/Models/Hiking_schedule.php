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
}
