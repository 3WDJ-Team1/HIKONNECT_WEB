<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HikingGroup;
use App\Models\User;

    /**
     * @var Model $group_model       A reference variable for Hiking_group model
     */
class GroupController extends Controller
{
    private $group_model = null;
   
    /**
     * Constructor for GroupController
     */
    public function __construct()
    {
        $this->group_model = new HikingGroup();
        $this->user_model = new User();
    }

    public function testing($key)
    {
        return $this->mountain_model
            ->getMountainNames($key);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($pageIndex)
    {
        $groupInformations  = $this->group_model->getGroupInformations($pageIndex, 'default');
        //$countOfPeople      = $this->group_model->getCountOfPeople($pageIndex, 'default');
        //return compact('groupInformations', 'countOfPeople');
        return $groupInformations;
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
        $title              = $request->input('title');
        $content            = $request->input('content');
        $start_date         = $request->input('date');
        $starting_point     = $request->input('stPoint');
        $stopover           = $request->input('spOver');
        $end_point          = $request->input('ePoint');
        $min_members        = $request->input('min');
        $max_members        = $request->input('max');

        $this->group_model->insertHikingGroup($title, $content, $start_date, $starting_point, 
                                              $stopover, $end_point, $min_members, $max_members);
    }

    /**
     * Display the specified resource.
     *
     * @param int $uuid 
     * 
     * @return \Illuminate\Http\Response
     */
    public function show($uuid)
    {
        $selectedHikingGroupInfo      = $this->group_model->showSelectedGroupInfo($uuid);
        return $selectedHikingGroupInfo;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id 
     * 
     * @return \Illuminate\Http\Response
     */
    public function edit($uuid)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param String                   $updateData 
     * @param int                      $uuid 
     * 
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $uuid)
    {
        return $this->group_model->updateSelectedGroupInfo($request->input(), $uuid);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $uuid 
     * 
     * @return \Illuminate\Http\Response
     */
    public function destroy($uuid)
    {
        $this->group_model->deleteHikingGroupInfo($uuid);
    }

    /**
     * Listup Grouplist by selected method.
     *
     * @param \Illuminate\Http\Request $request 
     * @param int                      $pageIndex
     * @param String                   $method 
     * 
     * @return \Illuminate\Http\Response
     */
    // public function listUp($pageIndex, $method)
    // {
    //     // $countOfPeople          = $this->group_model->getCountOfPeople($pageIndex, $method);
    //     // $groupInformations      = $this->grou p_model->getGroupInformations($pageIndex, $method);
    //     //  return compact('listUpData', 'countOfPeople');
    //     $listupGroupData           = $this->group_model->listUp($pageIndex, $method);
    //     return $listupGroupData;
    // }

    /**
     * Find Grouplist by selected method and corrected inputData.
     *
     * @param \Illuminate\Http\Request $request 
     * @param String                   $method 
     * @param String                   $inputData
     * 
     * @return \Illuminate\Http\Response
     */
    public function findData($method, $inputData)
    { 
        $findedGroupData           = $this->group_model->findData($method, $inputData);
        return $findedGroupData;
    }

    /**
     * Display the specified resource.
     *
     * @param int $id 
     * 
     * @return \Illuminate\Http\Response
     */
    public function groupNotification() 
    {
        //
    }
}
