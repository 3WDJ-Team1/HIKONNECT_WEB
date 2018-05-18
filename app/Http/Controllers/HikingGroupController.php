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
use Mockery\Exception;

/**
 * Controller class for Hiking_group
 *
 * @category Controllers
 * @package  App
 * @author   Sol Song <thdthf159@naver.com>
 * @license  MIT license
 * @link     https://github.com/3WDJ-Team1/HIKONNECT_WEB
 */
class HikingGroupController extends Controller
{
    private $_group_model = null;
    private $member_model = null;
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
        //
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        // 작성자 그룹에 자동 참여
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
        //
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
        $result = $this->_group_model->updateGroup($id,$title,$content,$min,$max);
        return response()->json($result);
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
        $this->_group_model->where('uuid', $id)->delete();
        return response()->json('true');
    }
    /**
     * @function    getGroupList
     * @brief       List of All Group
     *
     * @param \Illuminate\Http\Request $request
     *          select      if search group enter keyword
     *          input       search value
     * @return response json
     */
    public function getGroupList(Request $request)
    {
        $select = '';
        $request->get('select') == 'writer'     ? $select = 'writer'    : '';
        $request->get('select') == 'groupname'  ? $select = 'groupname' : '';
        $input  = $request->get('input');
        $page   = (int)$request->get('page');
        $result = $this->_group_model->getGroupList($page,$select,$input);
        return response()->json($result);
    }
    /**
     * @funtion     checkMember
     * @brief       Check to member state
     *
     * @param \Illuminate\Http\Request $request
     *         string userid
     *         string uuid
     *
     * @return if user is owner string owner
     *          if user is member string member
     *          if user is guest string guest
     */
    public function checkMember(Request $request) {
        try {
            $is_member = $this->member_model->checkMember($request->get('userid'),$request->get('uuid'));
            $is_owner = $this->_group_model->isOwner($request->get('userid'),$request->get('uuid'));
        } catch (Exception $e) {
            return 'Error : ' + $e;
        }
        if ($is_member == true && $is_owner == true)
            return response()->json('owner');
        elseif ($is_member == true && $is_owner == false)
            return response()->json('member');
        elseif ($is_member == false && $is_owner == false)
            return response()->json('guest');
        else
            throw new Exception('잘못된 값을 입력하셨습니다.');
    }
    /**
     * @funtion     groupInfo
     * @brief       Get Group Information
     *
     * @param \Illuminate\Http\Request $request
     *         string uuid
     *
     * @return Array groupInfo
     */
    public function groupInfo(Request $request) {
        return response()->json(HikingGroup::where('uuid',$request->get('uuid'))->get());
    }
    public function isOwner ($uuid, $userid) {
        if ($this->_group_model->isOwner($userid,$uuid) == true) {
            return 'true';
        } else
            return 'false';
    }
}
