<?php

Route::singularResourceParameters();

Route::get('/', 'LandingController@show');

Route::group(['middleware' => 'auth'], function () {

    Route::get('/dashboard', 'DashboardController@show')->name('home');

    Route::put('/settings/profile/details', 'ProfileDetailsController@update');

    Route::resource('projects', 'ProjectsController');

    Route::get('/projects/{project}/media', 'ProjectMediaController@show');
    Route::post('/projects/{project}/media', 'ProjectMediaController@store');
    Route::delete('/projects/{project}/media/{media}', 'ProjectMediaController@destroy');

});

/**
 * Spark routes overwrite
 */
// Settings Dashboard...
Route::get('/settings', 'Settings\DashboardController@show')->name('settings');

// Kiosk...
Route::get('/spark/kiosk', 'Kiosk\DashboardController@show')->name('kiosk');

// Authentication...
Route::get('/login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('/login', 'Auth\LoginController@login');
Route::get('/logout', 'Auth\LoginController@logout')->name('logout');

// Registration...
Route::get('/register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('/register', 'Auth\RegisterController@register');

// Password Reset...
Route::get('/password/reset/{token?}', 'Auth\PasswordController@showResetForm')->name('password.reset');