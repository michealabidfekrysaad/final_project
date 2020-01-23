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
Route::get('/contact', function () {
    return view('contact.index');
});
Route::resource('reports', 'reportController');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// Route::get('/login/{provider}', 'Auth\LoginController@redirect');
// Route::get('/login/{provider}/callback', 'Auth\LoginController@callback');
