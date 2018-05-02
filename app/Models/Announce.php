<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Model class for Announce
 *
 * @category Model
 * @package  App
 * @author   Sol Song <thdthf159@naver.com>
 * @license  MIT license
 * @link     https://github.com/3WDJ-Team1/HIKONNECT_WEB
 */

class Announce extends Model
{
    protected $table = 'announce';

    public function announceReg(Array $info) {
        Announce::insert($info);
    }

    public function getAnnounce($uuid, $page) {
        return Announce::where('hiking_group',$uuid)
            ->select(
                'title','content','writer','picture','created_at'
            )
            ->orderBy('created_at','DESC')
            ->skip($page)
            ->take(10)
            ->get();
    }
}
