<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EntryInfo;

class EntryInfoController extends Controller
{
    private $_entryInfoModel = null;

    public function __construct()
    {
        $this->_entryInfoModel = new EntryInfo();
    }

    public function entryGroup(Request $request)
    {
        $userUuid = $request->input('userUuid');
        $groupUuid = $request->input('groupUuid');

        return $this->_entryInfoModel->applyUserEntry($groupUuid, $userUuid);
    }

    public function appliedUsers(String $groupUuid)
    {
        return $this->_entryInfoModel->getAppliedUsers($groupUuid);
    }

    public function replyUserEntry(Request $request)
    {
        $groupUuid  = $request->input('groupUuid');
        $userUuid   = $request->input('userUuid');
        $isAccept   = $request->input('isAccept');

        if (is_null($groupUuid) || is_null($userUuid) || is_null($isAccept)) {
            return 'Wrong request body';
        }

        return $this->_entryInfoModel
            ->replyUserEntry($groupUuid, $userUuid, $isAccept);
    }

    public function rejectUserEntry(Request $request)
    {
        $groupUuid  = $request->input('groupUuid');
        $userUuid   = $request->input('userUuid');

        if (is_null($groupUuid) || is_null($userUuid)) {
            return 'Wrong request body';
        }

        return $this->_entryInfoModel
            ->rejectUserEntry($groupUuid, $userUuid);
    }
}
