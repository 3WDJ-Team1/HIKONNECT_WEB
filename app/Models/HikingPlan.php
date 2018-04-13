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
use Illuminate\Support\Facades\Storage;
use Nathanmac\Utilities\Parser\Facades\Parser;
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
        // if (Storage::disk('local')->exists('mount.gpx')) {
        //     $hikingPath =  Parser::xml(Storage::disk('local')->get('mount.gpx'));
        // }

        // return $hikingPath;
        // $hikingPaths = [];

        // foreach ($hikingPath['trk'][0]['trkseg'] as $paths) {
        //     foreach ($paths as $inx => $path) {
        //         $location["lat"] = $path["@lat"];
        //         $location["lng"] = $path["@lon"];

        //         $hikingPaths[$inx] = $location;
        //     }
        // }

        // return $hikingPaths;
        return $this->getGeoPath();
    }

    public function getGeoPath()
    {
        return $mountainPaths = Storage::disk('local')->get("mountain/111100101_geojson/PMNTN_SPOT_북악산_111100101.json");
        $mountCode = '11100101';

        if (Storage::disk('local')->exists('mountain/111100101_geojson/PMNTN_북악산_111100101.json')) {
            
        }

        return var_dump($mountainPaths['features'][0]['PMNTN_NM']);
    }
}
