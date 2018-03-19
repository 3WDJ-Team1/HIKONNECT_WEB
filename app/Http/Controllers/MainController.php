<?php

namespace App\Http\Controllers;

use App\Models\announce;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MainController extends Controller
{
    private $announce = null;
    public function __construct()
    {
        $this->announce = new announce();
    }

    public function get_Announce_Count($id) {
        //Get Announce Count
        $announce_count = announce::where('addressee',$id)->
        whereColumn('created_at','updated_at')->count();
        return response()->json($announce_count);
    }
}
