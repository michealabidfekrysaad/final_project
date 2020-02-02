<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServicepoeProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/contact', function () {
    return view('contact.index');
});
Route::get('/contact', function () {
    return view('contact.index');
});

Route::get('/about', function () {
    return view('about.index');
});

Route::get('/about/view1', function () {
    return view('about.view1');
});




Route::get('/home', 'HomeController@index')->name('home');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/people/details', function(){
    return view('people.personDetails');
});
Route::post('/filter/find','filterController@doSearchingQuery');

// Route::get('/users/{id}','UsersController@show')->name('users.show');
 Route::get('/login/{provider}', 'Auth\LoginController@redirect');
 Route::get('/login/{provider}/callback', 'Auth\LoginController@callback');

Route::get('/search' , 'reportController@getFormSearch');
// Route::post('/search' , 'reportController@SearchReports');
Route::post('/searchReports' , 'reportController@searchReports2');
Route::post('/searchCheckbox' , 'reportController@getSearchCheckbox');
Route::get('/getforitem/{category}','AttributeController@getAttributeList');
Route::get('/get-area/{id}','AttributeController@getAreas');
// Route::get('/cat' , 'categoryController@index');
Route::get('/showRepo/{id}' , 'reportController@showReport')->name('show.action');
// Route::get('/auth/facebook', 'Auth\LoginController@redirectToFacebook');
// Route::get('/auth/facebook/callback', 'Auth\LoginController@handleFacebookCallback');
// Route::get('/search' , 'reportController@getFormSearch');
// Route::post('/search' , 'reportController@SearchReports');

Auth::routes(['verify' => true]);
/******** Attribute CRUD *******/
Route::get('/attributeAdmin' , 'AttributeController@indexAdmin')->name('attribute.index');
//Route::get('/items/search' , 'AttributeController@index')->name('attribute.index');

Route::get('/createAttribute' , 'AttributeController@create')->name('attribute.create');
Route::post('/attribute' , 'AttributeController@store')->name('attribute.store');
Route::get('/showAttribute/{id}' , 'AttributeController@show')->name('attribute.show');
Route::get('/edit/{id}' , 'AttributeController@edit')->name('attribute.edit');
Route::put('/updateAttribute/{id}' , 'AttributeController@update')->name('attribute.update');


Route::delete('/deleteAttribute' , 'AttributeController@destroy')->name('attribute.destroy');

/***** Values CRUD *****/
Route::get('/valuesAdmin' , 'ValuesController@indexAdmin')->name('value.index');
Route::get('/values' , 'ValuesController@index')->name('value.index');
Route::get('/createValue' , 'ValuesController@create')->name('profile.create');
Route::post('/values' , 'ValuesController@store')->name('profile.store');
Route::get('/showValue/{id}' , 'ValuesController@show')->name('value.show');
Route::get('/editValue/{id}' , 'ValuesController@edit')->name('value.edit');
Route::put('/update/{id}' , 'ValuesController@update')->name('value.update');
Route::delete('/deleteValue/{id}' , 'ValuesController@delete')->name('value.delete');
Route::get('/getforitem/{category}','AttributeController@getAttributeList');


//islam fix 5ara
Route::get('/people/search/{type}','reportController@create');
Route::post('/people/search/post/{type}','reportController@store');
Route::get('get-area-list','reportController@getAreaList');
Route::get('/people/search','reportController@index')->name("people.home");//done
Route::get('/people/details/{report}','reportController@showReportDetails');//done
Route::get('/search' , 'reportController@getFormSearch');
Route::post('/search' , 'reportController@SearchReports');

Route::get('/liveSearch/action' , 'reportController@action')->name('search.action');
Route::get('/acceptOtherReport/{report}', 'reportController@acceptOtherReport')->name('reports.acceptOtherReport')->middleware('sessions');
Route::get('/RejectOtherReport', 'reportController@RejectOtherReport')->name('reports.RejectOtherReport')->middleware('sessions');
Route::get('/closereport/{report}', 'reportController@closeReport')->name('reports.closeReport');
Route::get('/viewResultFromNotification/{results}','ProfileController@viewResultFromNotification');
Route::get('/readNotification/{id}','ProfileController@readNotification');
Route::post('/sendEmail/{id}' , 'reportController@SendEmailVerify');
Route::get('/editReport/{report}' , 'reportController@edit')->name('repo.edit');
Route::post('/updateReport/{report}' , 'reportController@update')->name('repo.update');
Route::delete('/report/delete/{report}','reportController@destroy')->name('repo.delete');;
Route::get('/viewResultFromNotification/{results}','ProfileController@viewResultFromNotification');
Route::get('/readNotification/{id}','ProfileController@readNotification');
Route::get('/filter/{request}','reportController@doSearchingQuery');//done
Route::get('/profile' , 'ProfileController@index')->name('profile.index');
Route::get('/edit/{id}' , 'ProfileController@edit')->name('profile.edit');
Route::put('/update/profile/{user}' , 'ProfileController@update')->name('profile.update');
Route::get('auth/redirect/{provider}', 'Auth\LoginController@redirect');
Route::get('login/{provider}/callback', 'Auth\LoginController@callback');
Route::get('/admin', function(){
    return view('layouts.AdminPanel.app');
});
Route::get('/admin/1', function(){
    return view('layouts.AdminPanel.page');
});
Route::get('/admin/panel', function(){
    return view('layouts.AdminPanel.index');
});
Route::get('/people/image','UploadfileController@index');//done
Route::post('uploadfile','UploadfileController@upload');//done

Route::get('/', function () {
    return view('welcome');
});
//item

Route::get('/items/search' , 'itemController@index')->name('items.index');
Route::get('/filter/find/item/{data}' , 'itemController@doSearchingQuery');
Route::post('/items' , 'itemController@store')->name('items.store');
Route::get('/acceptMessage/{decision}/{descriptionValidation}' , 'itemController@AcceptMessage');
//end item
Route::get('/items/search/found','itemController@CityCategory');
Route::get('/get-state-list','itemController@getAreaList');
Route::get('/get/{category}','itemController@getAttributeList');
//Route::get('/items/search','itemController@getCategory');
Route::get('/liveSearch/actionItem' , 'itemController@actionItem');
Route::get('/valueofattribute/{id}','itemController@getAttributeValue');
Route::get('/showRepoItem/{id}' , 'itemController@show')->name('showItems.action');
Route::get('/items/search/found','itemController@create');
Route::get('/showReportItem/{item}','itemController@show');
Route::post('/sendEmailItem/{id}' , 'itemController@sendEmailVerifyItems');
