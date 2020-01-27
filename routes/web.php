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

//Route::get('/test','TestsController@test');

Route::resource('reports' , 'reportController');
Route::get('/contact', function () {
    return view('contact.index');
});
//Route::resource('reports', 'reportController');

// Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/people/search', function(){
    return view('people.find');
});
Route::get('/people/details', function(){
    return view('people.personDetails');
});
Route::post('/filter/find','filterController@doSearchingQuery');
// Route::get('/people/search/{type}', function($type){
//     return view('people.form',['type' => $type]);
// });
Route::get('/people/search/{type}','UploadfileController@createReport');

Route::post('/people/search/{type}','UploadfileController@report');
Route::get('/people/image','UploadfileController@index');
Route::post('uploadfile','UploadfileController@upload');
// Route::get('/users/{id}','UsersController@show')->name('users.show');

 

Route::get('/items/search', function(){
    return view('items.find');
});
Route::get('/items/search/found', function(){
    return view('items.form');
});
 
Route::get('/matchReport', function(){
    return view('matchReport');
});
Route::get('/editReport', function(){
    return view('editReport');
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
// Route::get('/auth/facebook', 'Auth\LoginController@redirectToFacebook');
// Route::get('/auth/facebook/callback', 'Auth\LoginController@handleFacebookCallback');
// Route::get('/search' , 'reportController@getFormSearch');
// Route::post('/search' , 'reportController@SearchReports');

Auth::routes(['verify' => true]);
/******** Attribute CRUD *******/
Route::get('/attributeAdmin' , 'AttributeController@indexAdmin')->name('attribute.index');
Route::get('/items/search' , 'AttributeController@index')->name('attribute.index');
Route::get('/createAttribute' , 'AttributeController@create')->name('attribute.create');
Route::post('/attribute' , 'AttributeController@store')->name('attribute.store');
Route::get('/showAttribute/{id}' , 'AttributeController@show')->name('attribute.show');
Route::get('/edit/{id}' , 'AttributeController@edit')->name('attribute.edit');
Route::put('/updateAttribute/{id}' , 'AttributeController@update')->name('attribute.update');
Route::delete('/deleteAttribute' , 'AttributeController@destroy')->name('attribute.destroy');

/***************/


/***** Profile CRUD *****/

    Route::get('/profile' , 'ProfileController@index')->name('profile.index');
    Route::get('/edit/{id}' , 'ProfileController@edit')->name('profile.edit');
    Route::put('/update/{id}' , 'ProfileController@update')->name('profile.update');


/************* */

/***** Values CRUD *****/
Route::get('/valuesAdmin' , 'ValuesController@indexAdmin')->name('value.index');
Route::get('/values' , 'ValuesController@index')->name('value.index');
Route::get('/createValue' , 'ValuesController@create')->name('profile.create');
Route::post('/values' , 'ValuesController@store')->name('profile.store');
Route::get('/showValue/{id}' , 'ValuesController@show')->name('value.show');
Route::get('/editValue/{id}' , 'ValuesController@edit')->name('value.edit');
Route::put('/update/{id}' , 'ValuesController@update')->name('value.update');
Route::delete('/deleteValue/{id}' , 'ValuesController@delete')->name('value.delete');


/************* */
