<?php
/**
 * 
 */
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Group;

/**
 * Controller for Group
 */
class GroupController extends Controller
{
    private $_group_model = null;

    /**
     * Constructor for GroupController
     */
    public function __construct()
    {
        $this->_group_model = new Group();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $groupList = $this->_group_model->getGroupList();

        $returnTag = "";

        foreach ($groupList as $index => $record) {
            $returnTag .= "<a href='/group/" . $record['uuid'] . "'>" . $record['uuid'] . "</a><br />";
        }
        
        return $returnTag;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return "
        <input /><br />
        <input /><br />
        <input /><br />
        <input /><br />
        <input /><br />
        <button onclick='createGroup()'>create</button>
        <script>
            function createGroup(){
                $.ajax({
                    method: 'post'
                });
            }
        </script>
        ";
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
}
