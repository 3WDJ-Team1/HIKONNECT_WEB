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
Route::get('group/{pageIndex?}/{perPage?}', 'GroupController@index');
Route::get('group/{method?}', 'GroupController@listUp');
Route::get('group/{method?}/{data?}','GroupController@findData');
Route::resource('group', 'GroupController');