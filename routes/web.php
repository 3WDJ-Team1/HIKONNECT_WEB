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
Route::resource('group', 'GroupController');
// 그룹 리스트보기
// Route::get('group/listUp/{pageIndex?}/{method?}', 'GroupController@listUp');
Route::get('group/show/{uuid?}', 'GroupController@show');
// 수정하기
Route::get('group/update/{uuid?}/{inputData?}', 'GroupController@update');
// 삭제하기
Route::get('group/destroy/{uuid?}', 'GroupController@destroy');
Route::get('group/groupNotification/{uuid?}', 'GroupController@groupNotification');



// 그룹 리스트 보기
Route::get('group/index/{pageIndex?}', 'GroupController@index');

// 작성자 = writer 날짜 = date
Route::get('group/findData/{method?}/{inputData?}', 'GroupController@findData');

// 저장하기
Route::post('group/store', 'GroupController@store'); //???????


// 산 이름 가져오는 URL (프론트 엔드에서 사용함)
Route::get('testing/{key?}', 'GroupController@testing');


