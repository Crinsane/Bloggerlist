<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register the API routes for your application as
| the routes are automatically authenticated using the API guard and
| loaded automatically by this application's RouteServiceProvider.
|
*/

Route::group(['prefix' => 'api', 'middleware' => 'auth:api'], function () {

    Route::get('/projects', 'Api\ProjectsController@index');

    Route::get('/projects/{project}/steps', 'Api\ProjectStepsController@index');

    Route::get('/branches', 'Api\BranchesController@index');

    Route::get('/activity', 'Api\ActivityController@index');
    Route::get('/users/{user}/activity', 'Api\ActivityController@show');

    Route::get('/company/{user}/projects', 'Api\ProjectsController@show');

    Route::get('/blogger/projects', 'Api\ProjectSubscriptionsController@index');
});
