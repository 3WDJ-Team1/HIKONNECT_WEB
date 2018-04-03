<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hiking_group;
use App\Models\User;

    /**
     * @var Model $model       A reference variable for Group model
     */
class GroupController extends Controller
{
    private $mountain_model = null;
    private $group_model = null;

    /**
     * Constructor for GroupController
     */
    public function __construct()
    {
        $this->group_model = new Hiking_group();
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
    public function index($pageIndex, $perPage)
    {
        $groupInformations  = $this->group_model->getGroupInformations($pageIndex, $perPage);
        $countOfPeople      = $this->group_model->getCountOfPeople($pageIndex, $perPage);
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
}
