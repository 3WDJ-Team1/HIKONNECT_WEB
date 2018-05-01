<?php
use Illuminate\Http\Request;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::middleware(
    'auth:api'
)->get(
    '/user', 
    function (Request $request) {
        return $request->user();
    }
);

Route::get(
    'testing/{key?}', 
    function ($mnt_name) {
        return  DB::table('mountain')
            ->where('mnt_name', 'LIKE', "%" . $mnt_name . "%")
            ->get();
    }
);



Route::group(
    [], 
    function () {
        /*Route::resource(
            'schedule',
            'ScheduleController'
        )->name('Schedule');*/
        // Radios Routing
        Route::get(
            'radioGram/{groupId}',
            'RadioGramContoller@getGroupRadios'
        )->name('radios');
        // Notification Routings
        Route::resource(
            'notice', 
            'NoticeController'
        );
        Route::get(
            'notice/{groupUuid}/{pageIndex?}/{perPage?}', 
            'NoticeController@index'
        )->name('noticePagination');
        Route::delete(
            'notice', 
            'NoticeController@destroy'
        )->name('deleteNotice');

        // Hiking group Routings
        Route::resource(
            'hikingGroup', 
            'HikingGroupController'
        );
        Route::get(
            'groupList/{idx}',
            'HikingGroupController@getGroupList'
        )->name('groupList');
        Route::get(
            'searchGroup/{idx}/{select}/{input}',
            'HikingGroupController@searchGroup'
        )->name('searchGroup');
        Route::get(
            'isOwner/{groupId}/{userId}',
            'HikingGroupController@isOwner'
        )->name('isOwner');

        // Entry info Routings
        Route::post(
            'entryGroup',
            'EntryInfoController@entryGroup'
        )->name('entryGroup');
        Route::patch(
            'replyUserEntry',
            'EntryInfoController@replyUserEntry'
        )->name('replyUserEntry');
        Route::get(
            'appliedUsers/{groupUuid}',
            'EntryInfoController@appliedUsers'
        )->name('appliedUsers');
        Route::delete(
            'rejectUserEntry',
            'EntryInfoController@rejectUserEntry'
        )->name('rejectUserEntry');
   
        Route::get(
            'groupMembers/{groupUuid}/{idx?}/{perIdx?}', 
            'HikingGroupController@getGroupMembers'
        )->name('groupMemberList');

        // User Profile Routings
        Route::get(
            'userProfile/{userUuid}', 
            'UserProfileController@getUserProfile'
        );

        // Login Routings
        Route::resource(
            '/user', 
            'UserController'
        );
        Route::post(
            '/login', 
            'LoginController@login'
        )->name('login');
        Route::post(
            '/loginprocess', 
            'LoginController@loginprocess'
        )->name('loginprocess');
        Route::post(
            '/login_app',
            'LoginController@login_app'
        )->name('login_app');
        /**
         * Login process using Socialite
         * 
         * Line     = enabled
         * Kakao    = disabled
         */
        Route::get(
            '/login/{providerName}', 
            'LoginController@redirectToProvider'
        )->name('SNSLogin');
        Route::get(
            '/login/{providerName}/redirect', 
            'LoginController@handleProviderCallback'
        )->name('SNSLoginRedirect');

        Route::post(
            '/logout', 
            'LoginController@logout'
        )->name('logout');
        Route::get(
            '/user/{id}', 
            'UserController@getImage'
        )->name('getImage');
        Route::get(
            '/mypage/{id}', 
            'UserController@showUserData'
        )->name('UserData');
        Route::post(
            '/graph/{id}', 
            'UserController@graph'
        )->name('graph');
        Route::get(
            'main/{id}', 
            'MainController@get_Announce_Count'
        )->name('Announce_Count');

        // 위치 메모 테스팅
        Route::resource(
            '/test',
            'testcontroller'
        );
        Route::post(
            '/getlm',
            'testcontroller@get_Memo_Info'
        )->name('Get Memo Information');
        Route::post(
            '/send',
            'FCMController@pushNotification'
        )->name('SendNotification');
        Route::post(
            '/position',
            'testcontroller@send_image_path'
        )->name('sendimage');
        // 위치 메모 테스팅 end
        Route::resource(
            '/groupPlan',
            'GroupPlanController'
        );
        Route::get(
            '/hikingPlan/{id}',
            'HikingPlanController@getGroupPlan'
        )->name('getGroupPlan');
        Route::resource(
            '/test',
            'testcontroller'
        );
        Route::post(
            '/getlm',
            'testcontroller@get_Memo_Info'
        )->name('Get Memo Information');
        Route::post(
            '/send',
            'FCMController@pushNotification'
        )->name('SendNotification');
    }
);

Route::group(
    ['prefix' => 'fcm'], 
    function () {
        Route::post(
            'pushNotification', 
            'FCMController@pushNotification'
        );
    }
);
