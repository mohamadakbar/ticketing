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

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/menu', 'ManageMenuController@index')->name('menu');
Route::get('/menu/show/{id}', 'ManageMenuController@show')->name('menu.view');
Route::get('/menu/create', 'ManageMenuController@create')->name('menu.create');
Route::post('/menu/store', 'ManageMenuController@store')->name('menu.store');
Route::post('/menu/update/{id}', 'ManageMenuController@update')->name('menu.update');
Route::get('/menu/delete/{id}', 'ManageMenuController@destroy')->name('menu.delete');

Route::get('/user', 'UserController@index')->name('user');
Route::get('/user/show/{id}', 'UserController@show')->name('user.view');
Route::get('/user/role/{id}', 'UserController@role')->name('user.role');
Route::post('/user/update_role', 'UserController@update_role')->name('user.updaterole');
Route::post('/user/update/{id}', 'UserController@update')->name('user.update');
Route::get('/user/delete/{id}', 'UserController@destroy')->name('user.delete');

Route::get('ticket', 'TicketController@index')->name('ticket');
Route::get('ticket/create', 'TicketController@create')->name('ticket.create');
Route::get('ticket/detail/{id}', 'TicketController@show')->name('ticket.detail');
Route::post('ticket/update/{id}', 'TicketController@update')->name('ticket.update');
Route::post('ticket/store', 'TicketController@store')->name('ticket.store');

