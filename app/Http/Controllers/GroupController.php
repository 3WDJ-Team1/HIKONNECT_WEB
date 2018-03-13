<?php

namespace App\Http\Controllers;

use App\Models\Hiking_group;
use Illuminate\Http\Request;

    /**
     * @var Model $model       A reference variable for Group model
     */
class GroupController extends Controller
{
    private $group_model = null;
    /**
     * Constructor for GroupController
     */
    public function __construct()
    {
        $this->group_model = new Hiking_group();
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($pageIndex, $perPage)
    {
        $groupInformations  = $this->group_model->getGroupInformations($pageIndex, $perPage);
        return $groupInformations;
        //$countOfPeople      = $this->group_model->getCountOfPeople();
        //return view('layouts/app', ['groups' => $groupInformations, 'persons' => $countOfPeople]);
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
        return $this->group_model->insertHikingGroup($request->filter_input());
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
        return $this->group_model->insertHikingGroup($request->filter_input());
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
        return $this->group_model->insertHikingGroup($request->filter_input());
    }
}
