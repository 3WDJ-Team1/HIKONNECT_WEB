<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{

	protected $table = 'group';

	public function getGroupInformations() {
		/**
		 * Get group list from database
		 * 
		 * @return Array
		 */
		$groupInfo = Group::all();
		return $groupInfo->get('group_name', 'mountain', 'group_owner','start_date', 'min_grouper');
	}

	public function getPeopleCount() {
		/**
		 * Get count of people in this group from database
		 * 
		 * @return $value
		 */
		
	}
}
