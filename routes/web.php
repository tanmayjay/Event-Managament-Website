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
    return view('welcome');
});

Auth::routes();

Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/booking', 'BookingsController@index')->name('booking.index');
Route::get('/booking/{event}/create', 'BookingsController@create')->name('booking.create');
Route::get('/booking/{event}', 'BookingsController@calculate');
Route::post('/booking/{event}', 'BookingsController@store')->name('booking.store');
Route::patch('/booking/{booking}', 'BookingsController@update')->name('booking.update');
Route::get('/booking/{booking}/ticket', 'BookingsController@payslip');

Route::get('/event', 'EventsController@index')->name('event.index');
Route::get('/event/create', 'EventsController@create')->name('event.create');
Route::post('/event', 'EventsController@store')->name('event.store');
Route::get('/event/{event}', 'EventsController@show')->name('event.show');
Route::get('/event/type/{type}', 'EventsController@filter');
Route::delete('/event/{event}', 'EventsController@destroy')->name('event.destroy');
Route::get('/event/{event}/edit', 'EventsController@edit')->name('event.edit');
Route::patch('/event/{event}', 'EventsController@update')->name('event.update');

Route::get('/user','UsersController@index')->name('user.index');
Route::get('/user/{user}','UsersController@show')->name('user.show');
Route::get('/user/{user}/edit/{item}','UsersController@edit')->name('user.edit');
Route::patch('/user/{user}/{item}','UsersController@update')->name('user.update');
Route::delete('/user/{user}','UsersController@destroy')->name('user.destroy');
