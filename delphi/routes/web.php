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

//ROUTES ABOUT GROUPS AND SESSIONS ETC:

Route::post('/home', 'SessionController@store')->name('sessionStore');

Route::post('user/{sessionCode}/create', 'SessionController@createListWithOptions')->name('createGroup');
Route::get('user/{sessionCode}/create', 'HomeController@newGroup');

Route::post('/welcome', 'WelcomeController@check')->name('check');

Route::get('user/{sessionCode}/total-voters', 'HomeController@totalVoters');

Route::get('user/{sessionCode}/{id}/view','HomeController@listView');
Route::post('user/{sessionCode}/{id}/view','HomeController@listViewActivate');