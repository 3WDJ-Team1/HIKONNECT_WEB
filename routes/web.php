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


Route::resource('/user','UserController');
Route::post('/login','LoginController@login')->name('login');
Route::post('/loginprocess','LoginController@loginprocess')->name('loginprocess');
Route::post('/logout','LoginController@logout')->name('logout');
Route::get('/mypage/{id}','UserController@showUserData')->name('UserData');
Route::post('/graph/{id}','UserController@graph')->name('graph');
Route::get('main/{id}','MainController@get_Announce_Count')->name('Announce_Count');
