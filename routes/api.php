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
Route::post('/test','TestsController@test');
Route::post('/test/store','TestsController@store');
Route::get('/test/index','TestsController@index');
Route::delete('/test/delete/{image}','TestsController@destroy');

Route::post('/report','reportController@store');
// Route::delete('/report/{report}','reportController@destroy');

