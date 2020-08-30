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

Auth::routes();

// ホーム
Route::get('/home', 'HomeController@index')->name('home');

// 入退店管理
Route::get('/userManagement', 'UserManagementController@index')->name('userManagement');
Route::post('/userManagement', 'UserManagementController@update')->name('userManagement_update');

// テーブル編集
Route::get('/userEdit/{number}', 'UserEditController@editEntry')->name('userEditEntry');
Route::post('/userEdit', 'userEditController@edit')->name('userEdit');

// 料金システム編集
Route::get('/feeSystem', 'FeeSystemController@index')->name('feeSystem');
Route::post('/feeSystem', 'FeeSystemController@update')->name('feeSystem_update');