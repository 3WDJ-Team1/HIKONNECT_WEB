<?php
/**
 * PHP version 7.0
 * 
 * @category Model
 * @package  App\Models
 * @author   bs Kwon <rnjs9957@gamil.com>
 * @license  MIT license
 * @link     https://github.com/3WDJ-Team1/HIKONNECT_WEB
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Request;

/**
 * Model for Notification
 * 
 * @category Model
 * @package  App
 * @author   bs Kwon <rnjs9957@gmail.com>
 * @license  MIT license
 * @link     https://github.com/3WDJ-Team1/HIKONNECT_WEB
 */

class HikingPlan extends Model
{
    protected $table = 'hiking_plan';

    /**
     * Parse xml to json for using mountain routes(gpx files)
     * in file system.
     * 
     * @return ????
     */
    public function xmlToJson()
    {
        $gpxPaths = Storage::get('maps/PMNTN_소백산_비로봉_438001301.gpx');

        return $gpxPaths;
    }
}
