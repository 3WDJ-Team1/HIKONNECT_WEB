<?php
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get(
    '/',
    function () {
        return view('layouts/app');
    }
);

Route::resource('notice', 'NoticeController');
Route::get('notice/{pageIndex?}/{perPage?}', 'NoticeController@index');
Route::resource('hiking-group', 'HikingGroupController');
Route::get('groupMembers/{groupUuid?}', 'HikingGroupController@getGroupMembers');
Route::get('userProfile/{userUuid}', 'UserProfileController@getUserProfile');


Route::get('testing', 'HikingGroupController@getGroupMembers');

