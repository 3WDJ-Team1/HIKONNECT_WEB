<?php
/**
 * PHP version 7.0 
 * Model for Hiking_group
 * 
 * @category Models
 * @package  App
 * @author   Areum Lee <leear5799@gmail.com>, bs Kwon <rnjs9957@gamil.com>
 * @license  MIT license
 * @link     https://github.com/3WDJ-Team1/HIKONNECT_WEB
 */
namespace App\Models;

use App\Request;
use Illuminate\Support\Facades\DB;

use App\Models\HikingGroup;

/**
 * Model for Notification
 * 
 * @category Model
 * @package  App
 * @author   bs Kwon <rnjs9957@gmail.com>
 * @license  MIT license
 * @link     https://github.com/3WDJ-Team1/HIKONNECT_WEB
 */

use Illuminate\Database\Eloquent\Model;

	/**
	 * @var Table 	$table	   	   Tables names used in this model
     */

class HikingGroup extends Model
{
	protected 	$table 		= 'hiking_group';

	public function getGroupMembers(String $groupUuid, $idx, $perIdx)
    {
        if (is_int($idx) xor is_int($perIdx)) {
            return 0;
        }
        $queryRes = DB::table('entry_info')
            ->select(
                'user_profile.nickname',
                'user_profile.image_path',
                'user_profile.phone',
                'user_profile.gender',
                'user_profile.age_group',
                'user_profile.scope'
            )->leftJoin(
                'user_profile', 
                'entry_info.user', 
                'user_profile.user'
            )->where(
                [
                    ['hiking_group', $groupUuid],
                ]
            )->skip($idx)
            ->take($perIdx)
            ->get();

        return $queryRes;
    }

    /**
     * Get group member's location
     * 
     * @param String $hiking_group 
     * 
     * @return void
     */
    public function getMembersLocation(String $hiking_group) 
    {

        $queryRes = DB::table('user_position')
            ->select('user', 'position')
            ->where('hiking_gruop', $hiking_group)
            ->get();

        return $queryRes;
    }

    /**
     * Get Group's detail infomation.
     * 
     * 
     */
    public function getGroupDetail(String $hiking_group) 
    {
        $queryRes = DB::table('hiking_group')
            ->join(
                'hiking_plan',
                'hiking_group.uuid',
                'hiking_plan.hiking_group'
            )->select(
                '*'
            )->where(
                'hiking_group.uuid', 
                $hiking_group
            )->get();

        return $queryRes;
    }

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
	public function getGroupInformations(int $pageIndex) {
	// 	if ($method == 'default') {
	// 		return $allGroupInfo 	= 	HikingGroup::leftJoin('recruitment', 'hiking_group.uuid', '=', 'recruitment.hiking_group')
	// 												->leftJoin('hiking_plan', 'recruitment.hiking_group', '=', 'hiking_plan.hiking_group')
	// 												->select (
	// 													'hiking_plan.hiking_group',
	// 													'recruitment.title',
	// 													'hiking_plan.end_point',
	// 													'hiking_group.owner',
	// 													'hiking_plan.start_date',
	// 													'hiking_group.min_members',
	// 													'hiking_group.max_members'
	// 												)
	// 												->orderBy('hiking_plan.created_at', 'desc')
	// 												->skip($pageIndex)->take(10)->get();
	// 	} else if ($method == 'NumberOfParticipants') {
	// 		return $allGroupInfo 	= 	HikingGroup::leftJoin('recruitment', 'hiking_group.uuid', '=', 'recruitment.hiking_group')
	// 												->leftJoin('hiking_plan', 'recruitment.hiking_group', '=', 'hiking_plan.hiking_group')
	// 												->select (
	// 													'recruitment.title',
	// 													'hiking_plan.end_point',
	// 													'hiking_group.owner',
	// 													'hiking_plan.created_at',
	// 													'hiking_plan.start_date',
	// 													'hiking_group.min_members',
	// 													'hiking_group.max_members'
	// 												)
	// 												->skip($pageIndex)->take(10)->get();
	return HikingGroup::leftJoin('recruitment', 'hiking_group.uuid', '=', 'recruitment.hiking_group')
			->leftJoin('hiking_plan', 'recruitment.hiking_group', '=', 'hiking_plan.hiking_group')
			->select (
				'recruitment.title',
				'hiking_plan.end_point',
				'hiking_plan.created_at',
				'hiking_plan.start_date',
				'hiking_group.min_members',
				'hiking_group.max_members'
			)
			->skip($pageIndex)->take(10)->get();
	}

    public function getWriters($pageIndex){
		return DB::table('user_profile')->leftJoin('hiking_group', 'user_profile.uuid', '=', 'hiking_group.owner')
								->select('user_profile.nickname')
								->skip($pageIndex)->take(10)->get();
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
	// public function getCountOfPeople(int $pageIndex, String $method) {
	// 	if ($method == 'default') {
	// 		return $countOfPeople = DB::table('entry_info')
	// 									->select(
	// 										'entry_info.hiking_group',
	// 										DB::raw('count(*) as total')
	// 									)
	// 									->groupBy('entry_info.hiking_group')
	// 									->get();
	// 	} else if ($method == 'NumberOfParticipants') {
	// 		return $countOfPeople 	= DB::table('entry_info')
	// 									->select(
	// 										'entry_info.hiking_group',
	// 										DB::raw('count(*) as total')
	// 									)
	// 									->groupBy('entry_info.hiking_group')
	// 									->orderBy('total', 'desc')
	// 									->get();
	// 		}
	// }

	// public function listUp($pageIndex, $method) {
	// 	/**
	// 	 * Get groupList from database, and then listUp all of grouplist by selected method.
	// 	 * <Sort of listup method>
	// 	 * 1. Latest
	// 	 * 2. NumberOfParticipants
	// 	 * 
	// 	 * @return Array
	// 	 */
	// 	if ($method == 'Latest') {
	// 		$listupGroupInfoData 	= $this->getGroupInformations($pageIndex, 'default');
	// 		$litupCountOfPeople		= $this->getCountOfPeople($pageIndex, 'default');
	// 	} else if ($method == 'NumberOfParticipants') {
	// 		return $listupGroupData = $this->getGroupInformations($pageIndex, 'NumberOfParticipants');
	// 	}
	// }

	// public function findData($method, $inputData) {
	// 	/**
	// 	 * Get groupList from database by selected method and inputData
	// 	 * 
	// 	 * @return Array
	// 	 */
	// 	if ($method == 'mnt_name') {
	// 		return $findedData		= HikingGroup::leftJoin('recruitment', 'hiking_group.uuid', '=', 'recruitment.hiking_group')
	// 												->leftJoin('hiking_plan', 'recruitment.hiking_group', '=', 'hiking_plan.hiking_group')
	// 												->select (
	// 													'recruitment.hiking_group',
	// 													'recruitment.title',
	// 													'hiking_plan.end_point',
	// 													'hiking_group.owner',
	// 													'hiking_plan.start_date',
	// 													'hiking_group.min_members',
	// 													'hiking_group.max_members'
	// 												)
	// 												->where('mountain.mnt_name', '=', $inputData)
	// 												->get();
	// 	} else if ($method == 'writer') {
	// 		return $findedData		= HikingGroup::leftJoin('recruitment', 'hiking_group.uuid', '=', 'recruitment.hiking_group')
	// 												->leftJoin('hiking_plan', 'recruitment.hiking_group', '=', 'hiking_plan.hiking_group')
	// 												->select (
	// 													'recruitment.hiking_group',
	// 													'recruitment.title',
	// 													'hiking_plan.end_point',
	// 													'hiking_group.owner',
	// 													'hiking_plan.start_date',
	// 													'hiking_group.min_members',
	// 													'hiking_group.max_members'
	// 												)
	// 												->where('hiking_group.owner', '=', $inputData)
	// 												->get();

	// 	} else if ($method == 'date') {
	// 		return $findedData		= HikingGroup::leftJoin('recruitment', 'hiking_group.uuid', '=', 'recruitment.hiking_group')
	// 												->leftJoin('hiking_plan', 'recruitment.hiking_group', '=', 'hiking_plan.hiking_group')
	// 												->select (
	// 													'recruitment.hiking_group',
	// 													'recruitment.title',
	// 													'hiking_plan.end_point',
	// 													'hiking_group.owner',
	// 													'hiking_plan.start_date',
	// 													'hiking_group.min_members',
	// 													'hiking_group.max_members'
	// 												)
	// 												->where('hiking_plan.start_date', '=', $inputData)
	// 												->get();
	// 	}
	// }

	public function showSelectedGroupInfo(String $uuid) {
		/**
		 * show HikingGroupInfo by correspond selected uuid. 
		 * 
		 * @return Array
		 */
		return $selectedHikingGroupInfo 	=  HikingGroup::leftJoin('recruitment', 'hiking_group.uuid', '=', 'recruitment.hiking_group')
															->leftJoin('hiking_plan', 'recruitment.hiking_group', '=', 'hiking_plan.hiking_group')
															->select (
																'recruitment.title',
																'recruitment.content',
																'hiking_plan.starting_point',
																'hiking_plan.stopover',
																'hiking_plan.end_point',
																'hiking_plan.start_date',
																'hiking_group.min_members',
																'hiking_group.max_members'
															)
															->where('hiking_group.uuid', '=', $uuid)
															->get();
	}

	public function insertHikingGroup($title, $content, $start_date, $starting_point, 
	 								  $stopover, $end_point, $min_members, $max_members) {
		/**
		 * insert HikingGroupInfo by correspond selected uuid.
		 * 
		 */
		DB::table('recruitment')->insert([
			'uuid'				=> '',
			'hiking_group'		=> '',
			'title' 	 		=> $title,
			'content' 	 		=> $content,
			'hits'				=> '',
			'created_at'		=> Carbon::now()->format('Y-m-d H:i:s'),
			'updated_at'		=> Carbon::now()->format('Y-m-d H:i:s')
		]);
		DB::table('hiking_plan')->insert([
			'uuid'				=> '',
			'hiking_group'		=> '',
			'start_date' 		=> $start_date,
			'starting_point' 	=> $starting_point,
			'stopover' 			=> $stopover,
			'end_point' 		=> $end_point,
			'created_at'		=> Carbon::now()->format('Y-m-d H:i:s'),
			'updated_at'		=> Carbon::now()->format('Y-m-d H:i:s')
		]);
		HikingGroup::insert([
			'uuid'				=> '',
			'name'				=> '',
			'owner'				=> '',
			'min_memebers'      => $min_members,
			'max_memebers'      => $max_members,
			'created_at'		=> Carbon::now()->format('Y-m-d H:i:s'),
			'updated_at'		=> Carbon::now()->format('Y-m-d H:i:s')
		]);

	}

	public function updateSelectedGroupInfo(Array $inputData, String $uuid) {
		/**
		 * update HikingGroupInfo by correspond selected uuid.
		 * 
		 */
		DB::table('recruitment')->where('uuid', '=', $uuid)
								->update([
								'title' => $request->get('title'),
								'content' => $request->get('content')
								]);
		DB::table('hiking_plan')->where('uuid', '=', $uuid)
								->insert([
								'starting_point' => $request->get('starting_point'),
								'stopover' => $request->get('stopover'),
								'end_point' => $request->get('end_point'),
								'start_date' => $request->get('start_date')
								]);
		HikingGroup::where('uuid', '=', $uuid)
					->update([
					'min_members' => $request->get('min_members'),
					'max_members' => $request->get('max_member')
					]);
	}

	public function deleteHikingGroupInfo(String $uuid) {
		/**
		 * delete HikingGroupInfo by correspond selected uuid.
		 * 
		 */
		DB::table('recruitment')->where('uuid', '=', $uuid)                      
								->delete();
		DB::table('hiking_plan')->where('uuid', '=', $uuid)
								->delete();
		HikingGroup::where('uuid', '=', $uuid)
					->delete();                             
	}
}
