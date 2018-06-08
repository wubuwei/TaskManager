<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'HomeController@welcome');

Route::auth();

Route::get('/home', 'HomeController@index');

Route::resource('projects', 'ProjectsController');

//tasks/charts这个精确路由，要在模糊路由得前面定义
Route::get('tasks/charts', ['as'=>'tasks.charts', 'uses'=>'TasksController@charts']);

Route::resource('tasks', 'TasksController');

Route::resource('tasks.steps', 'StepsController');

Route::post('tasks/{id}/check', ['as'=>'tasks.check', 'uses'=>'TasksController@check']);

