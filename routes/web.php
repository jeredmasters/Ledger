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

Route::get('/', function () {
    return view('facebook');
})->name('welcome');
Route::get('login/facebook', 'Auth\FacebookController@redirectToProvider');\
Route::get('login/facebook/push', 'Auth\FacebookController@handleJsPush');
Route::get('login/facebook/callback', 'Auth\FacebookController@handleProviderCallback');

Route::post('/auth/check', 'LoginController@check')->name('login');
Route::group(['prefix' => '/m','middleware' => 'simpleauth'], function () {
    Route::get('calendar', 'LogisticsController@calendar')->name('calendar');
});
