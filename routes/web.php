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
    return view('index');
})->name('home');

Route::get('tracks', 'TrackController@index')->name('tracks.index');
Route::get('tracks/{track}', 'TrackController@show')->name('tracks.show');

Route::get('team', 'UserController@index')->name('users.index');
Route::get('team/{user}', 'UserController@show')->name('users.show');

Route::get('contact', 'ContactController@index')->name('contact');
Route::post('contact', 'ContactController@send')->name('contact.send');

Route::get('licensing', 'LicensingController@index')->name('licensing');
