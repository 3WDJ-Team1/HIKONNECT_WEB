<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class location_memo extends Model
{
    protected $table = 'location_memo';

    public function Insert(Array $lm_info) {
        location_memo::insert($lm_info);
    }
}
