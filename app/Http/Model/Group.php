<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{

	protected $table = 'hiking_plan';

	public function getGroupInformations() {
		/**
		 * Get group list from database
		 * 
		 * @return Array
		 */
		return Group::all();
	}
	
	public function getPeopleCount() {
		/**
		 * Get groupId & count of people in this group from database
		 * 
		 * @return Array
		 */
		$countOfPeople = DB::table('entry_info')
						 ->select(hiking_group, DB::raw('count(*) as total'))
						 ->groupBy('hiking_group')
						 ->get();
		return $countOfPeople;				 
	}
}
