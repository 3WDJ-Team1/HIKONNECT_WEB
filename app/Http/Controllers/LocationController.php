<?php
/**
 * PHP version 7.0
 * 
 * @category Controller
 * @package  App\Http\Controllers
 * @author   bs Kwon <rnjs9957@gmail.com>
 * @license  MIT license
 * @link     https://github.com/3WDJ-Team1/HIKONNECT_WEB
 */
namespace App\Http\Controllers;

use App\Models\HikingGroup;
use Illuminate\Http\Request;

/**
 * Location controller
 * 
 * @category Controller
 * @package  App\Http\Controllers
 * @author   bs Kwon <rnjs9957@gmail.com>
 * @license  MIT license
 * @link     https://github.com/3WDJ-Team1/HIKONNECT_WEB
 */
class LocationController extends Controller
{
    private $_user_pos_model = null;

    /**
     * Class constructor
     */
    public function __construct()
    {
        $this->_user_pos_model = new UserPosition();
    }

    /**
     * A
     * 
     * @param String $hiking_group_uuid 
     * 
     * @return ?
     */
    public function groupMemberPosition(String $hiking_group_uuid)
    {
        return $this->_user_pos_model
            ->getMemberPosition($hiking_group_uuid);
    }
}
