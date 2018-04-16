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
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group([], function () {

    Route::resource('/user','UserController');
    Route::post('/login','LoginController@login')->name('login');
    Route::post('/loginprocess','LoginController@loginprocess')->name('loginprocess');
    Route::post('/logout','LoginController@logout')->name('logout');
    Route::post('/login_app','LoginController@login_app')->name('login_app');
    Route::get('/mypage/{id}','UserController@showUserData')->name('UserData');
    Route::post('/graph/{id}','UserController@graph')->name('graph');
    Route::get('main/{id}','MainController@get_Announce_Count')->name('Announce_Count');
    Route::get('/record/{id}','Usercontroller@get_Hiking_record')->name('Get Hiking Record');
    Route::resource('/test','testcontroller');
    Route::post('/getlm','testcontroller@get_Memo_Info')->name('Get Memo Information');
    Route::post('/send','FCMController@pushNotification')->name('SendNotification');
});