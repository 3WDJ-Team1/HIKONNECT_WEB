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

Route::group(
    [], 
    function () {
        //search Mountain Name
        Route::get(
            'searchMount/{key?}',
            function ($mnt_name) {
                return DB::table('mountain')
                    ->where('mnt_name', 'LIKE', "%" . $mnt_name . "%")
                    ->get();
            }
        );
        // Notification Routings
        Route::resource(
            'notice', 
            'NoticeController'
        );
        Route::get(
            'list_announce/{uuid}/{page}',
            'NoticeController@list_announce'
        )->name('list_announce');
        // Hiking group Routings
        Route::resource(
            'hikingGroup', 
            'HikingGroupController'
        );
        Route::post(
            'groupinfo',
            'HikingGroupController@groupInfo'
        )->name('groupInfo');
        Route::post(
            'checkMember',
            'HikingGroupController@checkMember'
        )->name('CheckMember');
        Route::post(
            'groupList',
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
        Route::post(
            'mygroup',
            'GroupMemberController@my_group'
        )->name('myGroup');
        Route::get(
            'hiking_history/{userid}',
            'ScheduleController@hiking_history'
        )->name('hiking history');
        Route::get(
            'hiking_count/{userid}',
            'ScheduleController@hiking_count'
        )->name('hiking count');
        Route::get(
            'checkScheduleMember/{userid}/{schedule_no}',
            'ScheduleController@check_schedule'
        )->name('check schedule');

        // Entry info Routings
        Route::resource(
            'member',
            'GroupMemberController'
        );
        Route::get(
            'list_member/{uuid}',
            'GroupMemberController@list_member'
        )->name('list_member');
        Route::post(
            'out_group',
            'GroupMemberController@out_group'
        )->name('out_group');
        // Login Routings
        Route::resource(
            '/user',
            'UserController'
        );
        Route::post(
            '/userinfo',
            'UserController@user_info'
        )->name('user_info');
        Route::get(
            '/hiking_history/{userid}',
            'ScheduleController@hiking_history'
        )->name('hiking_history');
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
            '/graph',
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
            '/getmemo',
            'LocationMemoController@getLocationMemo'
        )->name('Get Location Memo Information');
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
            'testcontroller@getLm'
        )->name('Get Memo Information');
        Route::post(
            '/send',
            'FCMController@pushNotification'
        )->name('SendNotification');
        //Group Schedule
        Route::resource(
            '/schedule',
            'ScheduleController'
        );
        Route::post(
            '/enter_schedule',
            'ScheduleController@enter_schedule'
        )->name('schedule_enter');
        Route::post(
            '/out_schedule',
            'ScheduleController@out_schedule'
        )->name('schedule_out');
        Route::post(
            '/myschedule',
            'ScheduleController@my_schedule'
        )->name('my_schedule');
        Route::post(
            '/makeScheduleList',
            'ScheduleController@makeScheduleList'
        )->name('makeScheduleList');
        Route::get(
            '/schedule_member/{uuid}/{schedule_no}',
            'ScheduleController@schedule_member_list'
        )->name('schedule_member_list');
        Route::get(
            '/wait/{userid}',
            'GroupMemberController@waitGroup'
        )->name('waitGroup');
        Route::resource(
            'radio',
            'RadioController'
        );
        Route::post(
            'reg_ip',
            'ScheduleController@reg_ip'
        )->name('Regist Ip Address');
        Route::get(
            'get_ip/{schedule_no}',
            'ScheduleController@get_ip'
        )->name('Get Ip Address');
        Route::post(
            'all_reg_ip',
            'ScheduleController@all_reg_ip'
        )->name('All Regist Ip Address');

        Route::post(
            'mnt_info',
            'MountainController@mountain_info'
        )->name('Get Mountain Information');
        Route::post(
            'mnt_image',
            'MountainController@mountain_image'
        )->name('Get Mountain Image');
        Route::get(
            'mnt_name/{mnt_id}',
            'MountainController@getMntName'
        )->name('Get Mountain Name');
        Route::post(
            'tour',
            'MountainController@tour'
        )->name('tour');
        Route::get(
            'hiking_count/{userid}',
            'ScheduleController@hiking_count'
        )->name('Count of hiking');

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
            'groupList/{idx}/{perIdx}/{mntName}/{writer}/{date}',
            'HikingGroupController@getGroupList'
        )->name('groupList');
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

        // Login Routings
        Route::resource(
            '/user', 
            'UserController'
        );
        Route::post(
            '/userinfo',
            'UserController@user_info'
        )->name('user_info');
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
            '/graph',
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
        Route::post(
            '/getlm',
            'testcontroller@get_Memo_Info'
        )->name('Get Memo Information');
        Route::post(
            '/send',
            'FCMController@pushNotification'
        )->name('SendNotification');
        Route::post(
            '/storesend',
            'testcontroller@updateScheduleMember'
        )->name('login_app');

        Route::post(
            '/storeLocationMemo',
            'testcontroller@storeLocationMemo'
        )->name('storeLocationMemo');

        Route::post(
            '/getAfterHikingInfo',
            '/testcontroller@getAfterHikingInfo'
        );
        //Group Schedule
        Route::resource(
            '/schedule',
            'ScheduleController'
        );
        Route::post(
            '/enter_schedule',
            'ScheduleController@enter_schedule'
        )->name('schedule_enter');
        Route::post(
            '/out_schedule',
            'ScheduleController@out_schedule'
        )->name('schedule_out');
        Route::post(
            '/myschedule',
            'ScheduleController@my_schedule'
        )->name('my_schedule');
        Route::post(
            '/getMemberNoByUserId',
            'testcontroller@getMemberNo'
        );
        Route::post(
            '/getLocationMemoDetail',
            'testcontroller@getLocationMemoDetail'
        );
        Route::post(
            '/getMemberDetail',
            'testcontroller@getMemberDetail'
        );
        Route::post(
            'getScheduleMembers',
            'testcontroller@getScheduleMembers'
        );
        Route::post(
            'updateHikingState',
            'testcontroller@updateHikingState'
        );
        Route::post(
            'getHikingResult',
            'testcontroller@getHikingResult'
        );
        Route::post(
            'getNowSchedule',
            'testcontroller@getNowSchedule'
        );
        Route::post(
            'getNowScheduleDetail',
            'testcontroller@getNowScheduleDetail'
        );
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
