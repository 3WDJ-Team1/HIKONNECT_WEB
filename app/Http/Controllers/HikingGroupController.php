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

use App\Models\Group_Member;
use Carbon\Carbon;
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
        $this->member_model = new Group_Member();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json('ttt');
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
        $groupinfo = array([
            'uuid'          => '',
            'title'         => $request->get('title'),
            'content'       => $request->get('content'),
            'leader'        => $request->get('writer'),
            'min_member'    => $request->get('min'),
            'max_member'    => $request->get('max'),
            'password'      => '',
            'port'          => 0,
            'created_at'    => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at'    => Carbon::now()->format('Y-m-d H:i:s')
        ]);
        $this->_group_model->groupReg($groupinfo);

        $uuid = HikingGroup::select('uuid')->orderBy('created_at','DESC')->first()['uuid'];
        $member_info = array([
            'userid'         => $request->get('writer'),
            'hiking_group'  => $uuid,
            'enter_whether' => 1,
            'enter_date'    => Carbon::now()->format('Y-m-d H:i:s'),
            'created_at'    => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at'    => Carbon::now()->format('Y-m-d H:i:s')
        ]);
        $group_member = new Group_Member();
        $group_member->memberReg($member_info);
        return response()->json('true');
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
        $title      =   $request->get('title');
        $content    =   $request->get('content');
        $min        =   $request->get('min');
        $max        =   $request->get('max');
        $this->_group_model->updateGroup($id,$title,$content,$min,$max);

        return response()->json('true');
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
    public function getGroupList(Request $request)
    {
        $select = '';
        $request->get('select') == 'writer'     ? $select = 'writer'    : '';
        $request->get('select') == 'groupname'  ? $select = 'groupname' : '';
        $input  = $request->get('input');
        $page   = $request->get('page');
        $result = $this->_group_model->getGroupList($page,$select,$input);
        return $result;
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

    public function checkMember(Request $request) {
        $is_member = $this->member_model->checkMember($request->get('userid'),$request->get('uuid'));
        $is_owner = $this->_group_model->isOwner($request->get('userid'),$request->get('uuid'));
        if ($is_member == true && $is_owner == true)
            return response()->json('owner');
        elseif ($is_member == true && $is_owner == false)
            return response()->json('member');
        else
            return response()->json('guest');
    }
}