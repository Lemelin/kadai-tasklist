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
Route::get('/', function () {
    return view('welcome');
});
*/

//Route::get('/', 'TasksController@index');

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', 'TasksController@index');

Route::resource('tasks', 'TasksController');

Route::get('createaccount', 'Auth\RegisterController@showRegistrationForm')->name('createAccount.get');
Route::post('createaccount', 'Auth\RegisterController@register')->name('createAccount.post');

Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login')->name('login.post');
Route::get('logout', 'Auth\LoginController@logout')->name('logout.get');

Route::group(['middleware' => ['auth']], function () {
    //Route::resource('users', 'UsersController', ['only' => ['index', 'show']]);
    Route::resource('tasks', 'TasksController', ['only' => ['show','create','edit','update','store', 'destroy']]);
});