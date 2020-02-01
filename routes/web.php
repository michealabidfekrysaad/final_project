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


Route::get('/', function () {
    return view('welcome');
});

//Route::get('/test','TestsController@test');

//Route::resource('reports' , 'reportController');
//Route::get('/contact', function () {
//    return view('contact.index');
//});
//Route::resource('reports' , 'reportController');
// Route::resource('reports' , 'reportController');
Route::get('/contact', function () {
    return view('contact.index');
});

Route::get('/about', function () {
    return view('about.index');
});

Route::get('/about/view1', function () {
    return view('about.view1');
});

//Route::resource('reports', 'reportController');

// Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');
//// Route::get('/login/{provider}', 'Auth\LoginController@redirect');
//// Route::get('/login/{provider}/callback', 'Auth\LoginController@callback');
//
//// Route::get('/search' , 'reportController@getFormSearch');
//// Route::post('/search' , 'reportController@SearchReports');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/people/search','reportController@index')->name("people.home");//done
Route::get('/people/details/{report}','reportController@showReportDetails');//done
Route::middleware('verified')->group(function () {;
Route::get('/people/image','UploadfileController@index');

Route::get('/items/search/found','itemController@create');
});
Route::get('/showReportItem/{item}','itemController@show');


Route::get('/home', 'HomeController@index')->name('home');
Route::get('/people/details', function(){
    return view('people.personDetails');
});
Route::post('/filter/find','filterController@doSearchingQuery');
Route::get('/filter/{request}','reportController@doSearchingQuery');//done

Route::get('/people/search/{type}','reportController@create');
Route::post('/people/search/{type}','reportController@store')->name('report.store');
Route::get('/people/image','UploadfileController@index');//done
Route::post('uploadfile','UploadfileController@upload');//done
// Route::get('/users/{id}','UsersController@show')->name('users.show');



Route::get('/items/search', 'itemController@index');
Route::get('/items/search/found', function(){
    return view('items.form');
});

Route::get('/matchReport', function(){
    return view('matchReport');
});
Route::get('/editReport', function(){
    return view('editReport');
});
Route::get('/itemDetails', function(){
    return view('items.itemDetails');
});

// Route::get('/login/{provider}', 'Auth\LoginController@redirect');
// Route::get('/login/{provider}/callback', 'Auth\LoginController@callback');

Route::get('/search' , 'reportController@getFormSearch');
// Route::post('/search' , 'reportController@SearchReports');
Route::post('/searchReports' , 'reportController@searchReports2');
Route::post('/searchCheckbox' , 'reportController@getSearchCheckbox');

// the ajax of city in item by micheal-------------------------------------------
Route::get('/items/search/found','itemController@CityCategory');
Route::get('/get-state-list','itemController@getAreaList');
Route::get('/get/{category}','itemController@getAttributeList');
Route::get('/getforitem/{category}','AttributeController@getAttributeList');
Route::get('/valueofattribute/{id}','itemController@getAttributeValue');
Route::get('/get-area/{id}','AttributeController@getAreas');

//Route::get('/items/search','itemController@getCategory');
// ------------------------------------------------------------------------------

//    Route::get('people/search/{type}','UploadfileController@CityCategory');


Route::get('get-area-list','reportController@getAreaList');


// Route::get('/cat' , 'categoryController@index');
// the ajax of city in item by micheal
Route::get('/liveSearch/actionItem' , 'itemController@actionItem')->name('search.actionItem');
Route::get('/liveSearch/action' , 'reportController@action')->name('search.action');
Route::get('/showRepo/{id}' , 'reportController@showReport')->name('show.action');
Route::get('/showRepoItem/{id}' , 'itemController@show')->name('showItems.action');
Route::get('auth/redirect/{provider}', 'Auth\LoginController@redirect');
Route::get('login/{provider}/callback', 'Auth\LoginController@callback');
// Route::get('/auth/facebook', 'Auth\LoginController@redirectToFacebook');
// Route::get('/auth/facebook/callback', 'Auth\LoginController@handleFacebookCallback');
// Route::get('/search' , 'reportController@getFormSearch');
// Route::post('/search' , 'reportController@SearchReports');

Auth::routes(['verify' => true]);
/******** Attribute CRUD *******/
Route::get('/attributeAdmin' , 'AttributeController@indexAdmin')->name('attribute.index');
  //Route::get('/items/search' , 'AttributeController@index')->name('attribute.index');
 // Route::get('/items/search' , 'itemController@index')->name('attribute.index');
Route::get('/createAttribute' , 'AttributeController@create')->name('attribute.create');
Route::post('/attribute' , 'AttributeController@store')->name('attribute.store');
Route::get('/showAttribute/{id}' , 'AttributeController@show')->name('attribute.show');
Route::get('/edit/{id}' , 'AttributeController@edit')->name('attribute.edit');
Route::put('/updateAttribute/{id}' , 'AttributeController@update')->name('attribute.update');

/***************/
Route::delete('/deleteAttribute' , 'AttributeController@destroy')->name('attribute.destroy');


/***** Profile CRUD *****/

    Route::get('/profile' , 'ProfileController@index')->name('profile.index');
    Route::get('/edit/{id}' , 'ProfileController@edit')->name('profile.edit');
    Route::put('/update/profile/{user}' , 'ProfileController@update')->name('profile.update');


/************* */

Route::get('/editReport/{report}' , 'reportController@edit')->name('repo.edit');
Route::post('/updateReport/{report}' , 'reportController@update')->name('repo.update');
Route::delete('/report/delete/{report}','reportController@destroy')->name('repo.delete');
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

Route::get('/acceptOtherReport/{report}', 'reportController@acceptOtherReport')->name('reports.acceptOtherReport')->middleware('sessions');
Route::get('/RejectOtherReport', 'reportController@RejectOtherReport')->name('reports.RejectOtherReport')->middleware('sessions');
Route::get('/viewResultFromNotification/{results}','ProfileController@viewResultFromNotification');
Route::get('/readNotification/{id}','ProfileController@readNotification');
Route::post('/sendEmail/{id}' , 'reportController@SendEmailVerify');

Route::post('/items' , 'itemController@store')->name('items.store');


Route::get('/error', function(){
    return view('error');
});
Route::get('/getforitem/{category}','AttributeController@getAttributeList');
Route::post('/sendEmailItem/{id}' , 'itemController@sendEmailVerifyItems');
Route::get('/acceptMessage/{decision}/{descriptionValidation}' , 'itemController@AcceptMessage');
//Route::post('/storeFahmy' , 'itemController@store');

 Route::get('/acceptMessage' , 'itemController@AcceptMessage');
Route::get('/error', function(){
    return view('error');
});


// admin routes-------------------------------------------------------------------
Route::get('/admin', function(){
    return view('layouts.AdminPanel.app');
});
Route::get('/admin/1', function(){
    return view('layouts.AdminPanel.page');
});
Route::get('/admin/panel', function(){
    return view('layouts.AdminPanel.index');
});
//da tab3 hamo hima 3ebs
Route::get('/charts', 'chartsController@index');
Route::get('/chartData', 'chartsController@chart');
Route::get('/chartData1', 'chartsController@chart1');
Route::get('/chartData2', 'chartsController@chart2');
// admin routes---------------------------------------------------------------------
// admin routes---------------------------------------------------------------------


//item filter
Route::get('/filter/find/item/{data}' , 'itemController@doSearchingQuery');
// end item filter

Route::get('/acceptOtherReport/{report}', 'reportController@acceptOtherReport')->name('reports.acceptOtherReport')->middleware('sessions');
Route::get('/RejectOtherReport', 'reportController@RejectOtherReport')->name('reports.RejectOtherReport')->middleware('sessions');
Route::get('/closereport/{report}', 'reportController@closeReport')->name('reports.closeReport');


