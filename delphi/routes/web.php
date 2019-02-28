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

Route::get('/about', 'PageController@about')->name('about');
Route::get('/contact','PageController@contact')->name('contact');
Route::post('/contact','PageController@submitContact');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//ROUTES ABOUT LISTS AND SESSIONS ETC:

Route::post('/home', 'SessionController@store')->name('sessionStore');


Route::post('user/{sessionCode}/create', 'SessionController@createListWithOptions');
Route::get('user/{sessionCode}/create', 'HomeController@newList');

Route::get('user/{sessionCode}/total-voters', 'HomeController@totalVoters');
