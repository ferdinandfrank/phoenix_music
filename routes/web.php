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

/*
|--------------------------------------------------------------------------
| Frontend Routes
|--------------------------------------------------------------------------
| Routes to the views and controller actions that can be called unauthenticated.
|
*/
Route::get('/', function () {
    return view('frontend.index');
})->name('home')->middleware('counter:index');

// Track Routes
Route::get('library/{track}', 'TrackController@show')->name('tracks.show')->middleware('counter:track,track,id');
Route::get('library', 'LibraryController@index')->name('library')->middleware('counter:library');

// Album Routes
Route::get('albums/{album}', 'AlbumController@show')->name('albums.show')->middleware('counter:albums');

// Category Routes
Route::get('categories/{category}', 'CategoryController@show')->name('categories.show')->middleware('counter:tracks');

// Team Routes
Route::get('team', 'TeamController@index')->name('team')->middleware('counter:team');
Route::get('team/{user}', 'UserController@show')->name('users.show')->middleware('counter:team');

// Contact Routes
Route::group(['prefix' => 'contact'], function () {
    Route::get('/', 'ContactController@index')->name('contact')->middleware('counter:contact');
    Route::post('/', 'ContactController@store')->name('contact.store');
});

// Licensing Routes
Route::get('licensing', 'LicensingController@index')->name('licensing')->middleware('counter:licensing');

/*
|--------------------------------------------------------------------------
| Media Manager Routes
|--------------------------------------------------------------------------
| Routes to handle file uploads through the media manager.
|
*/
\TalvBansal\MediaManager\Routes\MediaRoutes::get();

/*
|--------------------------------------------------------------------------
| Backend Routes
|--------------------------------------------------------------------------
| Routes to the views and controller actions that can only be called authenticated.
|
*/
Route::group(['middleware' => 'auth', 'prefix' => 'admin'], function () {

    // Dashboard Routes
    Route::get('', 'HomeController@index')->name('admin');

    // Help Route
    Route::get('help', function () {
        return view('backend.help.index');
    })->name('help');

    // Track Routes
    Route::resource('tracks', 'TrackController', [
        'except' => 'show'
    ]);

    // Album Routes
    Route::resource('albums', 'AlbumController', [
        'except' => 'show'
    ]);

    // Category Routes
    Route::resource('categories', 'CategoryController', [
        'except' => 'show'
    ]);

    // Statistic Routes
    Route::get('statistics', 'StatisticsController@index')->name('statistics.index');

    // Media Routes
    Route::get('media', 'MediaController@index')->name('media');
    Route::post('media/images', 'ImageController@store')->name('media.images.store');
    Route::post('media/images/modify', 'ImageController@modify')->name('media.images.modify');
    Route::post('media/images/rotate', 'ImageController@rotate')->name('media.images.rotate');

    // Composer / User Routes
    Route::get('users/privacy', 'UserController@editPrivacy')->name('users.privacy');
    Route::delete('users/notifications/{user?}', 'UserController@markNotifications')->name('users.notifications.mark');
    Route::resource('users', 'UserController', [
        'names'      => [
            'index'   => 'users.index',
            'edit'    => 'users.edit',
            'update'  => 'users.update',
            'destroy' => 'users.destroy',
            'create'  => 'users.create',
            'store'   => 'users.store',
        ],
        'except' => 'show'
    ]);

    // Tools Routes
    Route::get('tools', 'ToolsController@index')->name('tools.index');
    Route::post('tools/reset_index', 'ToolsController@resetIndex')->name('tools.reset_index');
    Route::post('tools/backup', 'ToolsController@createBackup')->name('tools.backup');
    Route::post('tools/cache_clear', 'ToolsController@clearCache')->name('tools.cache_clear');
    Route::post('tools/download_archive', 'ToolsController@handleDownload')->name('tools.download_archive');
    Route::post('tools/download_log', 'ToolsController@downloadLog')->name('tools.download_log');
    Route::post('tools/clear_log', 'ToolsController@clearLog')->name('tools.clear_log');
    Route::post('tools/enable_maintenance_mode',
        'ToolsController@enableMaintenanceMode')->name('tools.enable_maintenance_mode');
    Route::post('tools/disable_maintenance_mode',
        'ToolsController@disableMaintenanceMode')->name('tools.disable_maintenance_mode');

    // Settings Routes
    Route::get('settings', 'SettingsController@index')->name('settings.index');
    Route::put('settings', 'SettingsController@update')->name('settings.update');
});

/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
| Routes to the views and the controller actions to get authenticated
|
*/
Route::group(['namespace' => 'Auth'], function () {
    // Login / Logout Routes
    Route::group(['prefix' => 'auth'], function () {
        Route::post('login', 'LoginController@login')->name('login');
        Route::get('login', 'LoginController@showLoginForm')->name('login.show');

        Route::post('logout', 'LoginController@logout')->name('logout');
    });

    // Password Reset Routes
    Route::group(['prefix' => 'password'], function () {
        Route::get('forgot', 'ForgotPasswordController@showLinkRequestForm')->name('password.forgot');
        Route::post('forgot', 'ForgotPasswordController@sendResetLinkEmail')->name('password.forgot.store');

        Route::get('reset/{token}', 'ResetPasswordController@showResetForm')->name('password.reset');
        Route::post('reset', 'ResetPasswordController@reset')->name('password.reset.store');
    });
});
