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

use DB;
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

class RadiogramLog extends Model
{
    protected $table = 'radiogram_log';

    public function getGroupRadios(String $groupId)
    {
        try {
            return DB::table('radiogram_log as rl')
            ->select(
                'rl.created_at', 
                'rl.radiogram_path',
                'uf.image_path',
                'uf.nickname'
            )->join(
                'user_profile as uf',
                'uf.user',
                '=',
                'rl.sender'
            )->where('hiking_group', $groupId)
            ->get();
        } catch (Exception $e) {
            return $e->message();
        }
    }
}
