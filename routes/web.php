<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

// リアルタイム店内状況確認
Route::get('/realtime', 'RealtimeController@index')->name('realtime');

// 予約
Route::get('/booking', 'BookingController@index')->name('booking');
Route::post('/booking', 'BookingController@index')->name('booking');
Route::post('/booking_check', 'BookingController@check')->name('booking_check');
Route::post('/booking_exec', 'BookingController@create')->name('booking_exec');

// 予約の変更
Route::get('/booking/update', 'BookingUpdateController@index')->name('booking_update_index');
Route::get('/booking/update_booking_number_check', 'BookingUpdateController@bookingNumberCheck');
Route::post('/booking/update_booking_number_check', 'BookingUpdateController@bookingNumberCheck')->name('booking_number_check');
Route::post('/booking/update_check', 'BookingUpdateController@check')->name('booking_update_check');

Auth::routes();

// ホーム
Route::get('/home', 'HomeController@index')->name('home');

// 入退店管理
Route::get('/userManagement', 'UserManagementController@index')->name('userManagement');
Route::post('/userManagement', 'UserManagementController@update')->name('userManagement_update');

// テーブル編集
Route::get('/userEdit/{number}', 'UserEditController@editEntry')->name('userEditEntry');
Route::post('/userEdit', 'UserEditController@edit')->name('userEdit');

// 料金システム編集
Route::get('/feeSystem', 'FeeSystemController@index')->name('feeSystem');
Route::post('/feeSystem', 'FeeSystemController@update')->name('feeSystem_update');