<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('test','TestsController@test');
Route::post('/test/store','TestsController@store');
Route::get('/test/index','TestsController@index');
Route::delete('/test/delete/{image}','TestsController@destroy');

Route::get('/people/reports', 'reportController@index')->name('reports.index');
Route::get('/people/reports/{report}', 'reportController@show')->name('reports.show');
Route::post('/people/searchbyImageForLost', 'reportController@searchbyImageForLost')->name('reports.searchbyImageForLost');
Route::get('/closereport/{report}', 'reportController@closeReport')->name('reports.closeReport');
Route::get('/closereport/{report}', 'reportController@closeReport')->name('reports.closeReport');
Route::post('/people/reports', 'reportController@store')->name('reports.store')->middleware('sessions');
Route::get('/acceptOtherReport/{report}', 'reportController@acceptOtherReport')->name('reports.acceptOtherReport')->middleware('sessions');
Route::get('/RejectOtherReport', 'reportController@RejectOtherReport')->name('reports.RejectOtherReport')->middleware('sessions');

Route::get('/people/myreports', 'reportController@myReports')->name('reports.myReports');
Route::put('/people/myreports/update/{report}', 'reportController@update')->name('reports.update');
Route::delete('/people/myreports/delete/{report}', 'reportController@destroy')->name('reports.destroy');
