<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{

	protected $table = 'group';

	public function getGroupInformations() {
		// 현재 그룹에 참가중인 인원 DB에 추가해야 함
		/**
		 * Get group list from database
		 * 
		 * @return Array
		 */
		return Group::select('group_name', 'mountain', 'group_owner','start_date', 'min_grouper')->get();
	}
}
