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
    return view('welcome');
})->name('welcome');


Route::group(['prefix' => '/m','middleware' => 'simpleauth:2'], function () {
    Route::get('hello', function (){
        return view('m.hello')->with('user', session('user'));
    })->name('hello');
    Route::get('calendar', 'CalendarController@calendar')->name('calendar');
    Route::resource('bookings', 'BookingsController');
    Route::group(['prefix' => 'info'], function () {
        Route::get('/', function () { return view('m.info.index'); });
        Route::get('main', function () { return view('m.info.main'); });
        Route::get('flat', function () { return view('m.info.flat'); });
        Route::get('studio', function () { return view('m.info.studio'); });
    });
});

Route::group(['prefix' => '/a','middleware' => 'simpleauth:2'], function () {
    Route::resource('users', 'Admin\UsersController');
    Route::resource('log', 'Admin\LogController');
    Route::resource('settings', 'Admin\SettingController');
});

Route::group(['prefix' => '/login'], function () {
    Route::get('facebook', 'Auth\FacebookController@redirectToProvider');
    Route::get('facebook/push', 'Auth\FacebookController@handleJsPush');
    Route::get('facebook/callback', 'Auth\FacebookController@handleProviderCallback');
    Route::get('facebook/logout', 'Auth\FacebookController@logout');
});
