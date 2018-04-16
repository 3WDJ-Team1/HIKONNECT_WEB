<?php

namespace App\Http\Controllers;

use App\Models\RadiogramLog;
use Illuminate\Http\Request;

class RadioGramContoller extends Controller
{
    private $_radio_model = null;

    /**
     * 
     */
    public function __construct()
    {
        $this->_radio_model = new RadiogramLog();
    }

    public function getGroupRadios(String $groupId)
    {
        return $this->_radio_model->getGroupRadios($groupId);
    }
}
