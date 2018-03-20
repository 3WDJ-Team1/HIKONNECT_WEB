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

class HikingGroup extends Model
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
			return $allGroupInfo 	= 	HikingGroup::leftJoin('recruitment', 'hiking_group.uuid', '=', 'recruitment.hiking_group')
													->leftJoin('hiking_plan', 'recruitment.hiking_group', '=', 'hiking_plan.hiking_group')
													->select (
														'hiking_plan.hiking_group',
														'recruitment.title',
														'hiking_plan.end_point',
														'hiking_group.owner',
														'hiking_plan.start_date',
														'hiking_group.min_members',
														'hiking_group.max_members'
													)
													->orderBy('hiking_plan.created_at', 'desc')
													->skip($pageIndex)->take(10)->get();
		} else if ($method == 'NumberOfParticipants') {
			return $allGroupInfo 	= 	HikingGroup::leftJoin('recruitment', 'hiking_group.uuid', '=', 'recruitment.hiking_group')
													->leftJoin('hiking_plan', 'recruitment.hiking_group', '=', 'hiking_plan.hiking_group')
													->select (
														'recruitment.title',
														'hiking_plan.end_point',
														'hiking_group.owner',
														'hiking_plan.created_at',
														'hiking_plan.start_date',
														'hiking_group.min_members',
														'hiking_group.max_members'
													)
													->skip($pageIndex)->take(10)->get();
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
			return $countOfPeople = DB::table('entry_info')
										->select(
											'entry_info.hiking_group',
											DB::raw('count(*) as total')
										)
										->groupBy('entry_info.hiking_group')
										->get();
		} else if ($method == 'NumberOfParticipants') {
			return $countOfPeople 	= DB::table('entry_info')
										->select(
											'entry_info.hiking_group',
											DB::raw('count(*) as total')
										)
										->groupBy('entry_info.hiking_group')
										->orderBy('total', 'desc')
										->get();
			}
	}

	public function listUp($pageIndex, $method) {
		/**
		 * Get groupList from database, and then listUp all of grouplist by selected method.
		 * <Sort of listup method>
		 * 1. Latest
		 * 2. NumberOfParticipants
		 * 
		 * @return Array
		 */
		if ($method == 'Latest') {
			return $listupGroupData = $this->getGroupInformations($pageIndex, 'default');
		} else if ($method == 'NumberOfParticipants') {
			return $listupGroupData = $this->getGroupInformations($pageIndex, 'NumberOfParticipants');
		}
	}

	public function findData($method, $inputData) {
		/**
		 * Get groupList from database by selected method and inputData
		 * 
		 * @return Array
		 */
		if ($method == 'destination') {
			return $findedData		= HikingGroup::leftJoin('recruitment', 'hiking_group.uuid', '=', 'recruitment.hiking_group')
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
													->where('hiking_plan.end_point', '=', 'destination')
													->skip($pageIndex)->take(10)->get();
		} else if ($method == 'writer') {
			return $findedData		= HikingGroup::leftJoin('recruitment', 'hiking_group.uuid', '=', 'recruitment.hiking_group')
													->leftJoin('hiking_plan', 'recruitment.hiking_group', '=', 'hiking_plan.hiking_group')
													->leftJoin('user_profile', '')
													->select (
														'recruitment.hiking_group',
														'recruitment.title',
														'hiking_plan.end_point',
														'hiking_group.owner',
														'hiking_plan.start_date',
														'hiking_group.min_members',
														'hiking_group.max_members'
													)
													->where('hiking_group_owner', '=', 'writer')
													->skip($pageIndex)->take(10)->get();
		} else if ($method == 'date') {
			return $findedData		= HikingGroup::leftJoin('recruitment', 'hiking_group.uuid', '=', 'recruitment.hiking_group')
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
													->where('hiking_plan.start_date', '=', 'date')
													->skip($pageIndex)->take(10)->get();
		}
	}

	public function insertHikingGroup() {
		/**
		 * insert inputData in hiking_group table.
		 * 
		 * @return Array
		 */
		$Success;
		return $Success;
	}

}
