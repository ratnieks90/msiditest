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
Route::get('/registration','HomeController@reguser');
Route::get('/app',array('before' => 'auth', 'uses' =>'HomeController@app'));
Route::post('kapcha', 'HomeController@kapcha');

Route::get('personal', 'HomeController@personalView');
Route::get('folder', 'HomeController@folderView');
Route::get('/training', 'HomeController@training');

Route::post('day1','HomeController@personalView');
Route::post('load','HomeController@login');
Route::post('today','HomeController@addtoday');

Route::get('logout', array('uses' => 'HomeController@doLogout'));
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
Route::post('subtaskupdt', 'HomeController@updatesubtask');
Route::post('getfolder', 'HomeController@getfold');
Route::post('addfolder', 'HomeController@newfolder');
Route::post('registration', 'HomeController@reguser2');
Route::post('login', 'HomeController@loguser');
Route::post('updatecolumn', 'HomeController@updatefolder1');
Route::post('noteupdate', 'HomeController@noteupdate');
Route::post('notes', 'HomeController@getnotes');
Route::post('delnote', 'HomeController@deletenotes');
Route::post('fileup', 'HomeController@upfiles');
Route::post('getfiless', 'HomeController@getfiles');
Route::post('filess', 'HomeController@getfiles');
Route::post('getlastfile', 'HomeController@getlast');
Route::post('delfile', 'HomeController@delitefile');
//Route::post('logout', 'HomeController@dologout');
Route::post('getfolders2', 'HomeController@getfolders2');
Route::post('changestatus', 'HomeController@status');
Route::post('folderupdate', 'HomeController@foldupdt');
Route::post('savepositions', 'HomeController@savesorting');
Route::post('imgupload', 'HomeController@profileimg');
Route::post('getuserinfo3', 'HomeController@getuserinfo2');
Route::post('updtname', 'HomeController@updtname');
Route::post('updtsurname', 'HomeController@updtsurname');
Route::post('updtemail', 'HomeController@updtemail');