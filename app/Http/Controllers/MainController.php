<?php

namespace App\Http\Controllers;

use App\Models\Announce;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * Controller class for MainPage
 *
 * @category Controllers
 * @package  App
 * @author   Sol Song <thdthf159@naver.com>
 * @license  MIT license
 * @link     https://github.com/3WDJ-Team1/HIKONNECT_WEB
 */

class MainController extends Controller
{
    private $Announce = null;
    public function __construct()
    {
        $this->Announce = new Announce();
    }

    public function get_Announce_Count($id) {
        //Get Announce Count
        $Announce_count = Announce::where('addressee',$id)
            ->whereColumn('created_at','=','updated_at')->count();
        return response()->json($Announce_count);
    }
}