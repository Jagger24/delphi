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

//Password reset routes
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset.token');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');




Route::get('/home', 'HomeController@index')->name('home');
Route::get('/stats', 'StatsController@index')->name('stats');
Route::get('/profile', 'AccountController@index')->name('profile');

// Update user profile 
Route::delete('user/{id}/deleteUserAccount', 'AccountController@deleteUserAccount');
Route::post('user/{id}/editUserAccount', 'AccountController@editUserAccount');

//ROUTES ABOUT GROUPS AND SESSIONS ETC:

Route::post('/home', 'SessionController@store')->name('sessionStore');

Route::post('user/{sessionCode}/create', 'SessionController@createListWithOptions')->name('createGroup');
Route::get('user/{sessionCode}/create', 'HomeController@newGroup');

Route::post('/welcome', 'WelcomeController@check')->name('check');

Route::get('user/{sessionCode}/{id}/total-voters', 'HomeController@totalVoters');

Route::get('user/{sessionCode}/{id}/view','HomeController@listView');
Route::post('user/{sessionCode}/{id}/view','HomeController@listViewActivate');
Route::delete('user/{sessionCode}/delete','HomeController@deleteCode');
Route::delete('user/{sessionCode}/{groupId}/delete','HomeController@deleteList');

Route::delete('/{sessionCode}/{groupId}/{name}/deleteOption', 'HomeController@deleteOption');


Route::get('group/{sessionCode}/{id}','SessionController@statistics');
Route::post('group/{sessionCode}/{id}/stats-post','SessionController@statisticsPost');
Route::get('group/{sessioncode}/{id}/voting','SessionController@votingPage');
Route::post('group/{sessioncode}/{id}/voting', 'SessionController@saveVote')->name('saveName');
// Route::get('group/{sessioncode}/{id}/waiting','SessionController@waiting');

//AJAX CALLS FOR STUDENTS AND MAYBE STATS?
Route::get('student-count-ajax','Ajax@studentCount');
Route::get('stat-check','Ajax@statCheck');
Route::get('live-check','Ajax@liveCheck');