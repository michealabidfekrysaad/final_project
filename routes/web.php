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
// admin panel routes---------------------------------------------------------------
Route::get('/admin', function(){
    return view('layouts.AdminPanel.app');
});
Route::get('/admin/1', function(){
    return view('layouts.AdminPanel.page');
});
Route::get('/admin/panel', function(){
    return view('layouts.AdminPanel.index');
});

Route::get('/admin/panel/userstable','reportController@adminUsers');
Route::get('/user/{id}','reportController@showUser');
Route::get('user/edit/{id}','reportController@editUser');
Route::put('user/update/{id}','reportController@updateUser')->name('user.update');
Route::delete('user/{id}','reportController@destroyUser');
Route::get('/admin/panel/categorytable','categoryController@admincategory');
Route::get('category/create','categoryController@createCategory')->name('category.create');
Route::post('category/store','categoryController@storeCategory')->name('posts.store');
Route::delete('category/{id}','categoryController@destroyCategory');



Route::group(['middleware'=>'is-ban'], function(){
    Route::get('/home', 'HomeController@index')->name('home');
    //Route::get('/users' , 'UserController@index')->name('user.index');
    Route::get('/userUserRevoke/{id}', 'reportController@revoke')->name('users.revokeuser');
    Route::post('/userBan/{id}', 'reportController@ban')->name('users.ban');
});


// abdo routes admin ----------------------------------------------
/*********Admin Panel Table Category*********/

Route::get('/category/admin' , 'categoryController@index22Admin')->name('category.index22Admin');
Route::get('/category/create/admin' , 'categoryController@create22Admin')->name('category.create22Admin');
Route::post('/category/admin' , 'categoryController@stores22Admin')->name('category.stores22Admin');
// Route::get('/category/showAdmin/{id}' , 'categoryController@show22Admin')->name('category.show22Admin');
Route::get('/category/editAdmin/{category}' , 'categoryController@edit22Admin')->name('category.edit22Admin');
Route::put('/category/updateAdmin/{category}' , 'categoryController@update22Admin')->name('category.update22Admin');
Route::delete('/category/deleteAdmin/{id}' , 'categoryController@delete22Admin')->name('category.delete22Admin');
Route::post('/create/category/admin','categoryController@createCategoryAdmin');


/*********Admin Panel Table Items*********/

Route::get('/items/index' , 'itemController2@index2Admin')->name('items.index2Admin');
Route::get('/item/create' , 'itemController2@create2Admin')->name('items.create2Admin');
Route::post('/itemsStore' , 'itemController2@stores')->name('items.stores');
Route::get('/item/show/{id}' , 'itemController2@show2Admin')->name('items.show');
Route::get('/item/edit/{id}' , 'itemController2@edit2Admin')->name('items.edit');
Route::put('/item/update/{id}' , 'itemController2@update2Admin')->name('items.update2Admin');
Route::delete('/item/delete/{id}' , 'itemController2@delete2Admin')->name('items.delete2Admin');

/*************************/

/*********Admin Panel Table Reports*********/

Route::get('/admin/panel/report', 'reportController@indexAdmin')->name('reports.index');
Route::get('/report/create' , 'reportController@create2Admin')->name('reports.create');
// Route::post('/report/Add' , 'reportController@Stores2Admin')->name('reports.store'); micheal comment create
Route::get('/reportShow/{id}', 'reportController@show2Admin')->name('reports.show');
Route::get('/report/edit/{id}', 'reportController@edit2Admin')->name('reports.edit');
Route::put('/reportUpdate/{id}', 'reportController@Update2Admin')->name('reports.update');
Route::delete('/reportDelete/{id}' , 'reportController@DestroyByAdmin')->name('reports.delete');




// end of admin panel routes----------------------------------------------------------
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
