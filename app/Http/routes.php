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
Route::get('tasks/searchApi', ['as'=>'tasks.search', 'uses'=>'TasksController@searchApi']);
Route::resource('tasks', 'TasksController');

//防止与模糊路由冲突
Route::post('tasks/{tasks}/steps/complete', 'StepsController@completeAll');
Route::delete('tasks/{tasks}/steps/clear', 'StepsController@clearCompleted');

Route::resource('tasks.steps', 'StepsController');

Route::post('tasks/{id}/check', ['as'=>'tasks.check', 'uses'=>'TasksController@check']);

