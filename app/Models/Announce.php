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
    public function updateAnnounce($title, $content, $no) {
        Announce::where('no',$no)
            ->update(['title' => $title],
                ['content' => $content]);
    }
    public function getAnnounce($uuid, $page) {
        return Announce::where('hiking_group',$uuid)
            ->select(
                'no','title','content','writer','picture','created_at'
            )
            ->orderBy('created_at','DESC')
            ->skip($page * 10)
            ->take(10)
            ->get();
    }
    public function deleteAnnounce($no) {
        Announce::where('no',$no)->delete();
    }
}