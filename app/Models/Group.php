<?php
/**
 * PHP version 7.0
 * 
 * @category Model
 * @package  App\Models
 * @author   bs Kwon <rnjs9957@gmail.com>
 * @license  MIT license
 * @link     https://github.com/3wdj-team1/HIKONNECT_WEB
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Model for Group
 * 
 * @category Model
 * @package  App\Models
 * @author   bs Kwon <rnjs9957@gmail.com>
 * @license  MIT license
 * @link     https://github.com/3wdj-team1/HIKONNECT_WEB
 */
class Group extends Model
{
    protected $table = "group";

    /**
     * Get group's detail information.
     * 
     * @param String $id 
     * 
     * @return Array
     */
    public function getGroupDetail($id)
    {
        return Group::where('uuid', $id)->get();
    }

    /**
     * Get Group's member list
     * 
     * @param int $pageIndex a
     * @param int $perPage   a
     * 
     * @return Array
     */
    public function getGroupList($pageIndex = 0, $perPage = 5)
    {
        return Group::skip($pageIndex)->take($perPage)->get();
    }
}
