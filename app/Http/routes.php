<?php

Route::singularResourceParameters();

Route::get('/', 'LandingController@show');

Route::group(['middleware' => 'auth'], function () {

    Route::get('/dashboard', 'DashboardController@show')->name('home');

    Route::put('/settings/profile/details', 'ProfileDetailsController@update');

    Route::get('/company/projects', 'Companies\ProjectsController@index')->name('company.projects.index');
    Route::get('/company/projects/create', 'Companies\ProjectsController@create')->name('company.projects.create');
    Route::post('/company/projects', 'Companies\ProjectsController@store');
    Route::get('/company/projects/{project}/edit', 'Companies\ProjectsController@edit')->name('company.projects.edit');
    Route::put('/company/projects/{project}', 'Companies\ProjectsController@update');

    Route::get('/company/projects/{project}/media', 'Companies\ProjectMediaController@index');
    Route::post('/company/projects/{project}/media', 'Companies\ProjectMediaController@store');
    Route::delete('/company/projects/{project}/media/{media}', 'Companies\ProjectMediaController@destroy');

    Route::get('/projects', 'ProjectsController@index')->name('projects.index');
    Route::get('/projects/{project}', 'ProjectsController@show')->name('projects.show');

    Route::post('/projects/{project}/subscribe', 'ProjectSubscriptionController@store');
    Route::delete('/projects/{project}/unsubscribe', 'ProjectSubscriptionController@destroy');

    Route::post('/projects/{project}/favorite', 'ProjectFavoritesController@store');
    Route::delete('/projects/{project}/unfavorite', 'ProjectFavoritesController@destroy');
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