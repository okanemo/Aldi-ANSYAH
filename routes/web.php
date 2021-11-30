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

// Route::get('/', function () {
//     return view('dashboard');
// });


Route::get('/', 'DashboardController@index')->name('login');

Route::post('/dashboard-user', 'DashboardController@create')->name('create-user');

Route::get('/dashboard', 'DashboardController@dashboard')->name('dashboard');

Route::get('/logout', 'DashboardController@logout')->name('logout');

Route::get('/deposite', 'DashboardController@deposite')->name('deposite');
Route::post('/depo-action', 'DashboardController@deposite_action')->name('depo');

Route::get('/withdraw', 'DashboardController@withdraw')->name('withdraw');
Route::post('/withdraw_action', 'DashboardController@withdraw_action')->name('withdraw_action');

Route::get('/transfer', 'DashboardController@transfer')->name('transfer');
Route::post('/transfer_action', 'DashboardController@transfer_action')->name('transfer_action');