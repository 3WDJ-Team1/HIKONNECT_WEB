<?php
/**
 * PHP version 7.0
 * 
 * @category Controller
 * @package  Global
 * @author   bs Kwon <rnjs9957@gmail.com>
 * @license  MIT License
 * @link     https://github.com/3WDJ-Team1/HIKONNECT_WEB/
 */
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

use App\Models\HikingGroup;

/**
 * Controller for Group
 * 
 * @category Controller
 * @package  Global
 * @author   bs Kwon <rnjs9957@gmail.com>
 * @license  MIT License
 * @link     https://github.com/3WDJ-Team1/HIKONNECT_WEB/
 */
class HikingGroupController extends Controller
{
    private $_group_model = null;

    /**
     * Constructor for GroupController
     */
    public function __construct()
    {
        $this->_group_model = new HikingGroup();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return $this->request;
        // $groupList = $this->_group_model->getGroupList();

        // $returnTag = "";

        // foreach ($groupList as $index => $record) {
        //     $returnTag .= "<a href='/group/" . $record['uuid'] . "'>" . $record['uuid'] . "</a><br />";
        // }
        
        // return $returnTag;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return;
    }

    /**
     * Store a newly created resource in storage.
     * 
     * @param \Illuminate\Http\Request $request 
     * 
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return ;
    }

    /**
     * Display the specified resource.
     *
     * @param int $id 
     * 
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $groupDetail = $this->_group_model->getGroupDetail($id);

        $returnTag = "";

        foreach ($groupDetail as $index => $record) {
            $returnTag .= "";
        }

        return $groupDetail;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id 
     * 
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request 
     * @param int                      $id 
     * 
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        return $this->_notice_model->updateNotification($request->input(), $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id 
     * 
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $this->_notice_model->where('uuid', $id)->delete();
    }

    /**
     * Get group member list from database.
     * 
     * @param String $groupUuid Reference key(Group's UUID) Search
     *                          for group members
     * 
     * @return Array
     */
    public function getGroupMembers($groupUuid, $idx = 0, $perIdx = 10)
    {
        if ($idx && $perIdx) {
            if (!$idx = intval($idx) || !$perIdx = intval($perIdx)) {
                return response('Wrong request parameter type: $idx and $perIdx are must be Interger Type');
            }
        }

        $res = $this->_group_model
            ->getGroupMembers(
                $groupUuid,
                $idx,
                $perIdx
            );

        if ($res->isEmpty()) {
            return response("Query result is empty", 206);
        }

        return $res;
    }

    /**
     * 
     */
    public function getGroupList($idx, $perIdx, $orderBy = 'created_at') 
    {
        if ($idx && $perIdx) {
            if (!$idx = intval($idx) || !$perIdx = intval($perIdx)) {
                return response('Wrong request parameter type: $idx and $perIdx are must be Interger Type');
            }
        }

        $res = $this->_group_model
            ->getGroupList($idx, $perIdx, $orderBy);

        return $res;
    }

    /**
     * 
     */
    public function isOwner(String $groupId, String $userId) {
        $result = $this->_group_model
            ->isOwner($groupId, $userId);

        if (count($result) == 0) {
            return 'false';
        }

        return 'true';
    }

    public function searchGroup($page_num,$select,$input) {
        if ($select == 'name')
            return response()->json($this->_group_model->searchGroup($page_num,$input));
    }
}
