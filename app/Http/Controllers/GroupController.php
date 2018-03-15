<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hiking_group;
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
        $this->group_model = new Hiking_group();
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($pageIndex)
    {
        $groupInformations  = $this->group_model->getGroupInformations($pageIndex);
        $countOfPeople      = $this->group_model->getCountOfPeople($pageIndex);
        return compact('groupInformations', 'countOfPeople');
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

    /**
     * Listup Grouplist by selected method.
     *
     * @param \Illuminate\Http\Request $request 
     * @param String                   $method 
     * 
     * @return \Illuminate\Http\Response
     */
    public function listUp(Request $request, $method)
    {
        //
    }

    public function findData($method, $data)
    {
        //
    }
}
