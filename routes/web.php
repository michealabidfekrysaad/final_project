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
Route::resource('reports', 'reportController');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/people/search', function(){
    return view('people.find');
});

// Route::get('/people/search/{type}', function($type){
//     return view('people.form',['type' => $type]);
// });
Route::get('/people/search/{type}','UploadfileController@createReport');

Route::post('/people/search/{type}','UploadfileController@report');
Route::get('/people/image','UploadfileController@index');
Route::post('uploadfile','UploadfileController@upload');
 

// Route::get('/login/{provider}', 'Auth\LoginController@redirect');
// Route::get('/login/{provider}/callback', 'Auth\LoginController@callback');

// Route::get('/search' , 'reportController@getFormSearch');
// Route::post('/search' , 'reportController@SearchReports');