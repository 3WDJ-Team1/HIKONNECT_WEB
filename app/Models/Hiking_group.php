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
     */

class Hiking_group extends Model
{

	protected 	$table 		= 'hiking_group';

	/**
	 * Get groupId, postTitle, end_point, groupOwner, start_date, 
	 * min_members, max_members from database by selected method.
	 * <Sort of getGroupInformations method>
	 * 1. Basic -> default
	 * 2. NumberOfParticipants
	 * 
	 * @param int 		$pageIndex
	 * @param String 	$method		
	 * 
	 * @return Array
	 */
	public function getGroupInformations(int $pageIndex, String $method) {
		if ($method == 'default') {
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
													->skip($pageIndex)->take(10)->get();
		} else if ($method == 'NumberOfParticipants') {
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
													->get();
		}
	}

	/**
	 * Get current application people from database by selected method.
	 * <Sort of getCountOfPeople method>
	 * 1. Basic -> default
	 * 2. NumberOfParticipants
	 * 
	 * @param int 		$pageIndex
	 * @param String 	$method 
	 * 
	 * @return Array
	 */
	public function getCountOfPeople(int $pageIndex, String $method) {
		if ($method == 'default') {
			return $countOfPeople 	= DB::table('entry_info')
										->select('entry_info.hiking_group', DB::raw('count(*) as total'))
										->groupBy('entry_info.hiking_group')
										->orderBy('entry_info.hiking_group', 'asc')
										->skip($pageIndex)->take(10)->get();
		} else if ($method == 'NumberOfParticipants') {
			return $countOfPeople 	= DB::table('entry_info')
										->select('entry_info.hiking_group', DB::raw('count(*) as total'))
										->groupBy('entry_info.hiking_group')
										->skip($pageIndex)->take(10)->get();
			}
	}

	public function listUp($pageIndex, $method) {
		/**
		 * Get groupList from database, and then listUp all of grouplist by selected method.
		 * <Sort of listup method>
		 * 1. TheLatest
		 * 2. NumberOfParticipants
		 * 
		 * @return Array
		 */
		if ($method == 'TheLatest') {
			return $ListupGroupData 	= Hiking_group::leftJoin('recruitment', 'hiking_group.uuid', '=', 'recruitment.hiking_group')
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
														->skip($pageIndex)->take(10)->get();
		} else if ($method == 'NumberOfParticipants') {
			return $listupGroupData 	= Hiking_group::leftJoin('recruitment', 'hiking_group.uuid', '=', 'recruitment.hiking_group')
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
														->skip($pageIndex)->take(1)->get();
														}
	}

	public function findData($method, $inputData) {
		/**
		 * Get groupList from database by selected method and inputData
		 * 
		 * @return Array
		 */
		//목적지, 작성자, 날짜
		if ($method == 'ddd') {
			//
		} else if ($method == 'ddd') {
			//
		} else if ($method == 'ddd') {
			//
		}
		// return $findData		= DB:: ;
	}

	public function getCountOfAllData() {
		return ;
	}

}
