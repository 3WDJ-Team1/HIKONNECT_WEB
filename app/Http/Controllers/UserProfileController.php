<?php
/**
 * PHP version 7.0
 * 
 * @category Controller
 * @package  Controller
 * @author   bs Kwon <rnjs9957@gmail.com>
 * @license  MIT License
 * @link     https://github.com/3WDJ-Team1/HIKONNECT_WEB/
 */
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserProfile;

/**
 * Contoller Class for send UserProfile data set
 * 
 * @category Controller
 * @package  Controller
 * @author   bs Kwon <rnjs9957@gmail.com>
 * @license  MIT License
 * @link     https://github.com/3WDJ-Team1/HIKONNECT_WEB/
 * 
 * @var UserProfile $_userProfile_model Reference varibale UserProfile Model
 */
class UserProfileController extends Controller
{
    private $_userProfile_model = null;

    /**
     * Class's Contructor
     */
    public function __construct()
    {
        $this->_userProfile_model = new UserProfile();
    }

    /**
     * Get User's profile data set
     * 
     * @param String $userUuid 
     * 
     * @return Array
     */
    public function getUserProfile(String $userUuid)
    {
        return $this->_userProfile_model->getUserProfile($userUuid);
    }
}
