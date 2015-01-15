<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/','HomeController@index');
Route::get('personal', 'HomeController@personalView');
Route::get('folder', 'HomeController@folderView');
Route::get('/training', 'HomeController@training');

Route::post('day1','HomeController@personalView');
Route::post('load','HomeController@login');
Route::post('today','HomeController@addtoday');


Route::post('tasks', 'HomeController@showtasks');
Route::post('folderlist', 'HomeController@getfolders');
Route::post('addtask', 'HomeController@addtask');
Route::post('taskinfo', 'HomeController@gettaskinfo');
Route::post('delete', 'HomeController@deletetask');
Route::post('delfolder', 'HomeController@delfolder');
Route::post('uptaskname', 'HomeController@updttask');
Route::post('subtasks', 'HomeController@getsubtask');
Route::post('delsubtask', 'HomeController@delsub');
Route::post('addsub', 'HomeController@addsubtask');
Route::post('getfolder', 'HomeController@getfold');
Route::post('addfolder', 'HomeController@newfolder');
Route::post('registration', 'HomeController@reguser');
Route::post('login', 'HomeController@loguser');
Route::post('updatecolumn', 'HomeController@updatefolder1');
Route::post('addnote', 'HomeController@addnote');
Route::post('notes', 'HomeController@getnotes');
Route::post('delnote', 'HomeController@deletenotes');