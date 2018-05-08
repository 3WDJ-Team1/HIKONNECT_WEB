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

use App\Models\Announce;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Notification;
use App\Models\User;

/**
 * Controller class for User's Announce
 *
 * @category Controllers
 * @package  App
 * @author   Sol Song <thdthf159@naver.com>
 * @license  MIT license
 * @link     https://github.com/3WDJ-Team1/HIKONNECT_WEB
 */

class NoticeController extends Controller
{
    private $announce_model = null;
    private $_user_model = null;

    /**
     * Constructor for NoticeController
     */
    public function __construct()
    {
        $this->announce_model = new Announce();
        $this->_user_model = new User();
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($groupUuid, $perPage)
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
        $info = array([
            'title'         =>  $request->get('title'),
            'content'       =>  $request->get('content'),
            'writer'        =>  $request->get('writer'),
            'hiking_group'  => $request->get('uuid'),
            'picture'       => '',
            'created_at'    => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at'    => Carbon::now()->format('Y-m-d H:i:s')
        ]);
        $this->announce_model->announceReg($info);
        return response()->json('true');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id 
     * 
     * @return \Illuminate\Http\Response
     */
    public function show($groupUuid,$perPage)
    {
        $notifications = $this->announce_model
            ->getAnnounce(
                $groupUuid,
                $perPage
            );

        return response()->json($notifications);
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
    public function update(Request $request, $id = null)
    {
        return $request->input();
        // return $this->_notice_model->updateNotification($request->input(), $id);
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
        //
    }

    /**
     * @function    list_announce
     * @brief       List of Announces
     *
     * @param string uuid
     *         int page
     * @return \Illuminate\Http\Response
     */
    public function list_announce($uuid,$page) {
        $announce_list = $this->announce_model
            ->getAnnounce(
                $uuid,
                $page
            );

        return response()->json($announce_list);
    }
}
