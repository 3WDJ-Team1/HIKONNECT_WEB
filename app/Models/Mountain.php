<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Mountain extends Model
{
    protected $table = 'mountain';
    public function getMntName($mnt_id) {
        return
            Mountain::select('mnt_name')->where('mnt_id',$mnt_id)->get();
    }
}