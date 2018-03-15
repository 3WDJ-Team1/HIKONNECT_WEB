<?php
/**
 * PHP version 7.0
 * Model for Hiking_group
 * 
 * @category Models
 * @package  App
 * @author   Areum Lee <leear5799@gmail.com>
 * @license  MIT license
 * @link     https://github.com/3WDJ-Team1/HIKONNECT_WEB
 */
namespace App\Models;

use DB;
use Illuminate\Database\Eloquent\Model;

	/**
	 * @var Table 	$table	   	   Tables names used in this model
     * @var int 	$perPage       The page you want to load
     */

class Hiking_group extends Model
{

	protected 	$table 		= 'hiking_group';
	public 		$perPage	= 10;

	/**
	 * Get groupId, postTitle, end_point, groupOwner, start_date, 
	 * min_members, max_members from database.
	 * 
	 * @param int $pageIndex		
	 * 
	 * @return Array
	 */
	public function getGroupInformations(int $pageIndex) {
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

	/**
	 * Get current application people from database.
	 * 
	 * @param int $pageIndex
	 * 
	 * @return Array
	 */
	public function getCountOfPeople(int $pageIndex) {
		return $countOfPeople 	= DB::table('entry_info')
								 	->select('entry_info.hiking_group', DB::raw('count(*) as total'))
						 			->groupBy('entry_info.hiking_group')
									->skip($pageIndex)->take($perPage)->get();

	}

	public function listUp(Request $request, $method) {
		/**
		 * Get groupList from database, and then listUp all of grouplist by selected method
		 * 
		 * @return Array
		 */
		if ($method == 'latest') 
		{
			//
		} else if ($method == '')
		{

		} 
	}

	public function findData($method, $data) {
		/**
		 * Get groupList from database by selected method and inputData
		 * 
		 * @return Array
		 */
		// return $findData		= DB:: ;
	}

}
