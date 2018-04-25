<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\HikingPlan;

class HikingPlanController extends Controller
{
    private $_model_HikingPlan = null;

    /**
     * Class constructor
     */
    public function __construct()
    {
        $this->_model_HikingPlan = new HikingPlan();
    }

    public function index()
    {
        return $this->_model_HikingPlan->xmlToJson();
    }

    public function getGroupPlan($id) {
        return $this->_model_HikingPlan->getPlanPath($id);
    }
}
