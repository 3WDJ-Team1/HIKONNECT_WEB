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
Route::middleware('auth:api')
->get(
    '/user', 
    function (Request $request) {
        return $request->user();
    }
);

Route::group(
    [], 
    function () {
        // Notification Routings
        Route::resource(
            'notice', 
            'NoticeController'
        );
        Route::get(
            'notice/{groupUuid}/{pageIndex?}/{perPage?}', 
            'NoticeController@index'
        )->name('noticePagination');

        // Hiking group Routings
        Route::resource(
            'hikingGroup', 
            'HikingGroupController'
        );
        Route::get(
            'groupList/{idx}/{perIdx}/{orderBy?}',
            'HikingGroupController@getGroupList'
        )->name('groupList');

        Route::post(
            'group/store',
            'HikingGroupController@store'
        )->name('makeGroup');

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
        
        // 지울 것. 산 정보 가져오는 URL
        Route::get('testing/{mnt_name}', function ($mnt_name) {
            return DB::table('mountain')
                ->where('mnt_name', $mnt_name)
                ->get();
        })->name('testing');

        Route::post(
            '/HttpRequest',
            'GroupController@sendData'
        )->name('HttpRequest');
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