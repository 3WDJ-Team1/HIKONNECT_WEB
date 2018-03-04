<?php
/**
 * PHP version 7.0
 * 
 * @category Controllers
 * @package  App\Http\Controllers
 * @author   bs Kwon <rnjs9957@gmail.com>
 * @license  MIT license
 * @link     https://github.com/3WDJ-Team1/HIKONNECT_WEB
 */
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Notice;
use App\User;

/**
 * Controller for Notification
 * 
 * @category Controllers
 * @package  App\Http\Controllers
 * @author   bs Kwon <rnjs9957@gmail.com>
 * @license  MIT license
 * @link     https://github.com/3WDJ-Team1/HIKONNECT_WEB
 * 
 * @var Model $_model       A reference variable for Notice model
 */
class NoticeController extends Controller
{
    private $_notice_model = null;
    private $_user_model = null;

    /**
     * Constructor for NoticeController
     */
    public function __construct()
    {
        $this->_notice_model = new Notice();
        $this->_user_model = new User();
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $notifications = $this->_notice_model->getNotifications();
        $users = $this->_user_model->getUserList();
        return view('notice', ['userList' => $users]);
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
        return $this->_notice_model->insertNotification($request->input());
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
