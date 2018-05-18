<?php
namespace App\Http\Controllers;
use App\Models\Group_Member;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Mockery\Exception;

/**
 * Controller class for GroupMember
 *
 * @category Controllers
 * @package  App
 * @author   Sol Song <thdthf159@naver.com>
 * @license  MIT license
 * @link     https://github.com/3WDJ-Team1/HIKONNECT_WEB
 */
class GroupMemberController extends Controller
{
    private $member_model = null;
    public function __construct()
    {
        $this->member_model = new Group_Member();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($uuid)
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $member_info = array([
            'userid'        => $request->get('userid'),
            'hiking_group'  => $request->get('uuid'),
            'enter_whether' => 0,
            'enter_date'    => Carbon::now()->format('Y-m-d H:i:s'),
            'created_at'    => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at'    => Carbon::now()->format('Y-m-d H:i:s')
        ]);
        $this->member_model->memberReg($member_info);
        return response()->json('true');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     *          userid, uuid
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if ($id == 'true') {
            $this->member_model->accept_member($request->get('userid'),$request->get('uuid'));
            return response()->json('true');
        }
        elseif ($id == 'false') {
            $this->member_model->delete_member($request->get('userid'),$request->get('uuid'));
            return response()->json('false');
        }
        else
            return 'error';
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    /**
     * @funtion     out_group
     * @brief       Out Group
     *
     * @param \Illuminate\Http\Request $request
     *         userid
     *         uuid
     *
     * @return Delete User to Group List
     *
     */
    public function out_group(Request $request) {
        $result = $this->member_model->delete_member($request->get('userid'),$request->get('uuid'));
        return response()->json($result);
    }
    /**
     * @function    list_member
     * @brief       Group's member
     *
     * @param string uuid
     *        int state
     * @return List of group member
     */
    public function list_member($uuid) {
        if ($this->member_model->get_member_list($uuid,0) != 'error') {
            $not_enter = $this->member_model->get_member_list($uuid,0);
            $enter = $this->member_model->get_member_list($uuid,1);
            $member_list = array([
                'not_enter' => $not_enter,
                'enter'     => $enter
            ]);
            return $member_list;
        } else
            return 'false';
    }
    /**
     * @function    my_group
     * @brief       My Group
     *
     * @param \Illuminate\Http\Request $request
     *          userid
     *
     * @return List of group participating
     */
    public function my_group (Request $request) {
        $result = $this->member_model->my_group($request->get('userid'));
        if ($result != 'false')
            return response()->json($result);
        else
            return response()->json('false');
    }
    /**
     * @function    waitGroup
     * @brief       My Group
     *
     * @param string userid
     *
     * @return List of groups not yet accepted
     */
    public function waitGroup ($userid) {
        $result = $this->member_model->waitGroup($userid);
        if ($result != false)
            return response()->json($result);
        else
            return response()->json('false');
    }
}