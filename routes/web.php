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
Route::get('group/index/{pageIndex?}', 'GroupController@index');
Route::get('group/listUp/{pageIndex?}/{method?}', 'GroupController@listUp');
Route::get('group/findData/{method?}/{inputData?}', 'GroupController@findData');
Route::get('group/show/{uuid?}', 'GroupController@show');
Route::post('group/store', 'GroupController@store');
Route::get('group/update/{uuid?}/{inputData?}', 'GroupController@update');
Route::get('group/destroy/{uuid?}', 'GroupController@destroy');
Route::get('group/groupNotification/{uuid?}', 'GroupController@groupNotification');
Route::resource('group', 'GroupController');                       
