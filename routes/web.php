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

use App\Http\Controllers\filterController;

Route::get('/', function () {
    return view('welcome');
});

//Route::get('/test','TestsController@test');

Route::resource('reports' , 'reportController');
Route::get('/contact', function () {
    return view('contact.index');
});

// Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/people/search', function(){
    return view('people.find');
});

// Route::get('/login/{provider}', 'Auth\LoginController@redirect');
// Route::get('/login/{provider}/callback', 'Auth\LoginController@callback');

// Route::get('/search' , 'reportController@getFormSearch');
// Route::post('/search' , 'reportController@SearchReports');

Auth::routes(['verify' => true]);
