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

use App\Http\Middleware\increaseClick;
use App\Http\Middleware\increaseView;

Route::get('/contact', function () {
    return view('contact.index');
})->middleware(increaseView::class);
Route::get('/contact', function () {
    return view('contact.index');
})->middleware(increaseView::class);

Route::get('/about', function () {
    return view('about.index');
})->middleware(increaseView::class);

Route::get('/about/view1', function () {
    return view('about.view1');
})->middleware(increaseView::class);
Route::group(['middleware' => ['auth']], function () {

});

Route::get('/home', 'HomeController@index')->name('home')->middleware(increaseView::class);
Route::get('/people/details', function () {
    return view('people.personDetails');
})->middleware(increaseView::class);
Route::post('/filter/find', 'filterController@doSearchingQuery')->middleware(increaseClick::class);

// Route::get('/users/{id}','UsersController@show')->name('users.show');
Route::get('/login/{provider}', 'Auth\LoginController@redirect')->middleware(increaseClick::class);
Route::get('/login/{provider}/callback', 'Auth\LoginController@callback');

Route::get('/search', 'reportController@getFormSearch');
// Route::post('/search' , 'reportController@SearchReports');
Route::post('/searchReports', 'reportController@searchReports2');
Route::post('/searchCheckbox', 'reportController@getSearchCheckbox');
Route::get('/getforitem/{category}', 'AttributeController@getAttributeList')->middleware(increaseClick::class);
Route::get('/get-area/{id}', 'AttributeController@getAreas')->middleware(increaseClick::class);
// Route::get('/cat' , 'categoryController@index');
Route::get('/showRepo/{id}', 'reportController@showReport')->name('show.action')->middleware(increaseView::class);
// Route::get('/auth/facebook', 'Auth\LoginController@redirectToFacebook');
// Route::get('/auth/facebook/callback', 'Auth\LoginController@handleFacebookCallback');
// Route::get('/search' , 'reportController@getFormSearch');
// Route::post('/search' , 'reportController@SearchReports');

Auth::routes(['verify' => true]);
/******** Attribute CRUD *******/
Route::get('/attributeAdmin', 'AttributeController@indexAdmin')->name('attribute.index');
//Route::get('/items/search' , 'AttributeController@index')->name('attribute.index');

Route::get('/createAttribute', 'AttributeController@create')->name('attribute.create');
Route::post('/attribute', 'AttributeController@store')->name('attribute.store');
Route::get('/showAttribute/{id}', 'AttributeController@show')->name('attribute.show');
Route::get('/edit/{id}', 'AttributeController@edit')->name('attribute.edit');
Route::put('/updateAttribute/{id}', 'AttributeController@update')->name('attribute.update');


Route::delete('/deleteAttribute', 'AttributeController@destroy')->name('attribute.destroy');

/***** Values CRUD *****/
Route::get('/valuesAdmin', 'ValuesController@indexAdmin')->name('value.index');
Route::get('/values', 'ValuesController@index')->name('value.index');
Route::get('/createValue', 'ValuesController@create')->name('profile.create');
Route::post('/values', 'ValuesController@store')->name('profile.store');
Route::get('/showValue/{id}', 'ValuesController@show')->name('value.show');
Route::get('/editValue/{id}', 'ValuesController@edit')->name('value.edit');
Route::put('/update/{id}', 'ValuesController@update')->name('value.update');
Route::delete('/deleteValue/{id}', 'ValuesController@delete')->name('value.delete');
Route::get('/getforitem/{category}', 'AttributeController@getAttributeList');


//islam fix 5ara
Route::get('/people/search/{type}', 'reportController@create')->middleware(increaseView::class);
Route::post('/people/search/post/{type}', 'reportController@store')->middleware(increaseClick::class);
Route::get('get-area-list', 'reportController@getAreaList')->middleware(increaseClick::class);
Route::get('/people/search', 'reportController@index')->name("people.home")->middleware(increaseView::class);//done
Route::get('/people/details/{report}', 'reportController@showReportDetails')->middleware(increaseView::class);//done
Route::get('/search', 'reportController@getFormSearch')->middleware(increaseView::class);
Route::post('/search', 'reportController@SearchReports')->middleware(increaseClick::class);

Route::get('/liveSearch/action', 'reportController@action')->name('search.action')->middleware(increaseClick::class);
Route::get('/acceptOtherReport/{report}', 'reportController@acceptOtherReport')->name('reports.acceptOtherReport')->middleware('sessions')->middleware(increaseClick::class);
Route::get('/RejectOtherReport', 'reportController@RejectOtherReport')->name('reports.RejectOtherReport')->middleware('sessions')->middleware(increaseClick::class);
Route::get('/closereport/{report}', 'reportController@closeReport')->name('reports.closeReport')->middleware(increaseClick::class);
Route::get('/viewResultFromNotification/{results}', 'ProfileController@viewResultFromNotification')->middleware(increaseClick::class);
Route::get('/readNotification/{id}', 'ProfileController@readNotification')->middleware(increaseClick::class);
Route::post('/sendEmail/{id}', 'reportController@SendEmailVerify')->middleware(increaseClick::class);
Route::get('/editReport/{report}', 'reportController@edit')->name('repo.edit')->middleware(increaseView::class);
Route::post('/updateReport/{report}', 'reportController@update')->name('repo.update')->middleware(increaseClick::class);
Route::delete('/report/delete/{report}', 'reportController@destroy')->name('repo.delete')->middleware(increaseClick::class);
Route::get('/readNotification/{id}', 'ProfileController@readNotification')->middleware(increaseClick::class);
Route::get('/filter/{request}', 'reportController@doSearchingQuery')->middleware(increaseClick::class);//done
Route::get('/profile', 'ProfileController@index')->name('profile.index')->middleware(increaseView::class);
Route::get('/edit/{id}', 'ProfileController@edit')->name('profile.edit')->middleware(increaseView::class);
Route::put('/update/profile/{user}', 'ProfileController@update')->name('profile.update')->middleware(increaseClick::class);
Route::get('auth/redirect/{provider}', 'Auth\LoginController@redirect')->middleware(increaseClick::class);
Route::get('login/{provider}/callback', 'Auth\LoginController@callback');
Route::get('/admin', function () {
    return view('layouts.AdminPanel.app');
});
Route::get('/admin/1', function () {
    return view('layouts.AdminPanel.page');
});
Route::get('/admin/panel', function () {
    return view('layouts.AdminPanel.index');
});
Route::get('/people/image', 'UploadfileController@index')->middleware(increaseView::class);//done
Route::post('uploadfile', 'UploadfileController@upload')->middleware(increaseClick::class);//done

Route::get('/', function () {
    return view('welcome');
})->middleware(increaseView::class);
Route::get('/charts', 'chartsController@index');
Route::get('/chartData', 'chartsController@chart');
Route::get('/chartData1', 'chartsController@chart1');
Route::get('/chartData2', 'chartsController@chart2');
Route::get('/twoline', 'chartsController@viewAndClick');

Route::get('/items/search', 'itemController@index')->name('items.index')->middleware(increaseView::class);
Route::get('/filter/find/item/{data}', 'itemController@doSearchingQuery')->middleware(increaseClick::class);
Route::post('/items', 'itemController@store')->name('items.store')->middleware(increaseClick::class);
Route::get('/acceptMessage/{decision}/{descriptionValidation}', 'itemController@AcceptMessage')->middleware(increaseClick::class);
//end item
Route::get('/items/search/found', 'itemController@CityCategory')->middleware(increaseClick::class);
Route::get('/get-state-list', 'itemController@getAreaList')->middleware(increaseClick::class);
Route::get('/get/{category}', 'itemController@getAttributeList')->middleware(increaseClick::class);
//Route::get('/items/search','itemController@getCategory');
Route::get('/liveSearch/actionItem', 'itemController@actionItem')->middleware(increaseClick::class);
Route::get('/valueofattribute/{id}', 'itemController@getAttributeValue')->middleware(increaseClick::class);
Route::get('/showReportItem/{id}', 'itemController@show')->middleware(increaseClick::class)->middleware(increaseView::class);
Route::get('/items/search/found', 'itemController@create');
Route::post('/sendEmailItem/{id}', 'itemController@sendEmailVerifyItems')->middleware(increaseClick::class);


Route::get('locale/{locale}', function ($locale) {
    Session::put('locale', $locale);
    return redirect()->back();
});
