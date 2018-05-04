<?php

namespace App\Http\Controllers;

use App\Models\Group_Member;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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

    public function out_group(Request $request) {
        $this->member_model->delete_member($request->get('userid'),$request->get('uuid'));
        return response()->json('true');
    }

    public function list_member($uuid,$state) {
        if ($state == 0) {
            $member_list = $this->member_model->get_member_list($uuid,$state);
        }
        elseif ($state == 1) {
            $member_list = $this->member_model->get_member_list($uuid,$state);
        }

        return $member_list;
    }

    public function my_group (Request $request) {
        $result = $this->member_model->my_group($request->get('userid'));
        return response()->json($result);
    }
}
