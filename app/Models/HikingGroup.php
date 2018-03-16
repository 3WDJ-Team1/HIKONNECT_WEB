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
use Illuminate\Support\Facades\DB;

use App\Models\HikingGroup;

/**
 * Model for Notification
 * 
 * @category Model
 * @package  App
 * @author   bs Kwon <rnjs9957@gmail.com>
 * @license  MIT license
 * @link     https://github.com/3WDJ-Team1/HIKONNECT_WEB
 */

class HikingGroup extends Model
{
    protected $table = 'hiking_group';

    /**
     * 
     */
    public function getGroupMembers(String $groupUuid)
    {
        $queryRes = DB::table('entry_info')
            ->select('user as uuid')
            ->where(
                [
                    ['hiking_group', $groupUuid],
                    ['is_accepted', '1'],
                ]
            )->get();

        return $queryRes;
    }
}
