<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
/**
 * Model class for Announce
 *
 * @category Model
 * @package  App
 * @author   Sol Song <thdthf159@naver.com>
 * @license  MIT license
 * @link     https://github.com/3WDJ-Team1/HIKONNECT_WEB
 */
class Hiking_schedule extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'hiking_schedule';
    public function scheduleReg(Array $info) {
        Hiking_schedule::insert($info);
    }
    public function scheduleUpdate(Request $request,$id) {
        Hiking_schedule::where('no',$id)->update([
            'title'      => $request->get('title'),
            'content'    => $request->get('content'),
            'route'      => json_encode($request->get('route')),
            'mnt_id'     => $request->get('mnt_id'),
            'start_date' => $request->get('stDate'),
        ]);
    }
    public function my_schedule($userid) {
        return
            Hiking_schedule::select('no','title','leader','content','route','start_date','mnt_id')
                ->where([
                    ['schedule_member.userid',$userid]
                ])->join('schedule_member','schedule_member.schedule','=','hiking_schedule.no')->get();
    }
}