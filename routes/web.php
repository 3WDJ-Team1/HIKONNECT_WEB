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
use Faker as Faker;

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

Route::get('xmltesting', 'HikingPlanController@index');
 
Route::resource('group', 'GroupController');

Route::post('/list', 'GroupController@jiyoon');

// 나중에 삭제 할 것 ============
Route::get('testing/{key?}', 'GroupController@testing');
// ==============================

// Login Routings
Route::resource('/user', 'UserController');
Route::post('/login', 'LoginController@login')->name('login');
Route::post('/loginprocess', 'LoginController@loginprocess')->name('loginprocess');
/**
 * Login process using Socialite
 * 
 * Line     = enabled
 * Kakao    = disabled
 */
Route::get('/login/{providerName}', 'LoginController@redirectToProvider');
Route::get('/login/{providerName}/redirect', 'LoginController@handleProviderCallback');

Route::post('/logout', 'LoginController@logout')->name('logout');
Route::get('/user/{id}', 'UserController@getImage')->name('getImage');
Route::get('/mypage/{id}', 'UserController@showUserData')->name('UserData');
Route::post('/graph/{id}', 'UserController@graph')->name('graph');
Route::get('main/{id}', 'MainController@get_Announce_Count')->name('Announce_Count');
