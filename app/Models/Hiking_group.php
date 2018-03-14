<?php

namespace App\Models;

use DB;
use Illuminate\Database\Eloquent\Model;

class Hiking_group extends Model
{

	protected $table = 'hiking_group';

	public function getGroupInformations(int $pageIndex, int $perPage) {
		/**
		 * Get groupOwner, max_members, min_members from database
		 * 
		 * @return Array
		 */
		return $allGroupInfo 	= Hiking_group::leftJoin('recruitment', 'hiking_group.uuid', '=', 'recruitment.hiking_group')
												->leftJoin('hiking_plan', 'recruitment.hiking_group', '=', 'hiking_plan.hiking_group')
												->select (
													'recruitment.hiking_group',
													'recruitment.title',
													'hiking_plan.end_point',
													'hiking_group.owner',
													'hiking_plan.start_date',
													'hiking_group.min_members',
													'hiking_group.max_members'
												)
												->skip($pageIndex)->take($perPage)->get();
	}

	public function getCountOfPeople(int $pageIndex, int $perPage) {
		/**
		 * Get current application people from database
		 * 
		 * @return Array
		 */
		return $countOfPeople 	= DB::table('entry_info')
								 	->select('entry_info.hiking_group', DB::raw('count(*) as total'))
						 			->groupBy('entry_info.hiking_group')
									->skip($pageIndex)->take($perPage)->get();

	}

	// public function listUp($method) {
	// 	/**
	// 	 * Get groupList from database, and then listUp all of grouplist by selected method
	// 	 * 
	// 	 * @return Array
	// 	 */
	// 	return $listUpData		= DB::table()
	// }

	// public function findData($method, $data) {
	// 	/**
	// 	 * Get groupList from database by selected method and inputData
	// 	 * 
	// 	 * @return Array
	// 	 */
	// 	return $findData		= DB::
	// }

}
