<?php

namespace App\Models;

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
		return $allGroupInfo 	= Hiking_group::all()
												->skip($pageIndex)->take($perPage)->get();
	}

	public function getCountOfPeople() {
		/**
		 * Get current application people from database
		 * 
		 * @return Array
		 */
		return $countOfPeople 	= DB::table('entry_info')
								 	->select(hiking_group, DB::raw('count(*) as total'))
						 			->groupBy('hiking_group')
									->get();
	}

	// public function listUp($method) {
	// 	/**
	// 	 * Get groupList from database, and then listUp all of grouplist by selected method
	// 	 * 
	// 	 * @return Array
	// 	 */
	// 	return $listUpData		= DB::
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
