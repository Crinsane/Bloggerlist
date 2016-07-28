<?php

Route::singularResourceParameters();

Route::get('/', 'LandingController@show');

Route::group(['middleware' => 'auth'], function () {

    // Dashboard
    Route::get('/dashboard', 'DashboardController@show')->name('home');

    // Setting profile details
    Route::put('/settings/profile/details', 'ProfileDetailsController@update');

    // Company project creation and editing
    Route::get('/company/projects', 'Companies\ProjectsController@index')->name('company.projects.index');
    Route::get('/company/projects/create', 'Companies\ProjectsController@create')->name('company.projects.create');
    Route::post('/company/projects', 'Companies\ProjectsController@store');
    Route::get('/company/projects/{project}/edit', 'Companies\ProjectsController@edit')->name('company.projects.edit');
    Route::put('/company/projects/{project}', 'Companies\ProjectsController@update');

    // Company project media management
    Route::get('/company/projects/{project}/media', 'Companies\ProjectMediaController@index');
    Route::post('/company/projects/{project}/media', 'Companies\ProjectMediaController@store');
    Route::delete('/company/projects/{project}/media/{media}', 'Companies\ProjectMediaController@destroy');

    // All projects
    Route::get('/projects', 'ProjectsController@index')->name('projects.index');
    Route::get('/projects/{project}', 'ProjectsController@show')->name('projects.show');

    // Project subscription
    Route::post('/projects/{project}/subscribe', 'ProjectSubscriptionsController@store');
    Route::delete('/projects/{project}/unsubscribe', 'ProjectSubscriptionsController@destroy');

    // Project favorite
    Route::post('/projects/{project}/favorite', 'ProjectFavoritesController@store');
    Route::delete('/projects/{project}/unfavorite', 'ProjectFavoritesController@destroy');

    Route::get('/bloggers', 'BloggersController@index')->name('bloggers.index');
    Route::get('/bloggers/{user}', 'BloggersController@show')->name('bloggers.show');

    Route::get('/companies', 'CompaniesController@index')->name('companies.index');
    Route::get('/companies/{user}', 'CompaniesController@show')->name('companies.show');

    Route::post('/users/{user}/follow', 'UserFollowersController@store');
    Route::delete('/users/{user}/unfollow', 'UserFollowersController@destroy');

    Route::get('/oauth/facebook', function (\App\SocialMedia\Facebook $facebook) {
        $facebook->handleCallback();

        return redirect('/settings#/socialmedia');
    });

    Route::get('/oauth/twitter', function (\App\SocialMedia\Twitter $twitter) {
        $twitter->handleCallback();

        return redirect('/settings#/socialmedia');
    });

    Route::get('/oauth/instagram', function (\App\SocialMedia\Instagram $instagram) {
        $instagram->handleCallback();

        return redirect('/settings#/socialmedia');
    });
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