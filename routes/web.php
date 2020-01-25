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

Route::resource('reports' , 'reportController');
Route::get('/contact', function () {
    return view('contact.index');
});
//Route::resource('reports', 'reportController');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/people/search', function(){
    return view('people.find');
});

// Route::get('/login/{provider}', 'Auth\LoginController@redirect');
// Route::get('/login/{provider}/callback', 'Auth\LoginController@callback');

Route::get('/search' , 'reportController@getFormSearch');
// Route::post('/search' , 'reportController@SearchReports');
Route::post('/searchReports' , 'reportController@searchReports2');
Route::post('/searchCheckbox' , 'reportController@getSearchCheckbox');

Route::get('/liveSearch/action' , 'reportController@action')->name('search.action');
Route::get('/showRepo/{id}' , 'reportController@showReport')->name('show.action');
Route::get('/login/google', 'Auth\LoginController@redirectToGoogle');
Route::get('/login/google/callback', 'Auth\LoginController@handleGoogleCallback');
Route::get('/auth/facebook', 'Auth\LoginController@redirectToFacebook');
Route::get('/auth/facebook/callback', 'Auth\LoginController@handleFacebookCallback');