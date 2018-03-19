<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class announce extends Model
{
    protected $table = 'announce';

    public function get_Announce_Count($id) {
        announce::where('created_at','updated_at')
            ->where('uuid',$id)->first();
    }
}
