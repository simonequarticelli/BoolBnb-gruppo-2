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

Route::name('api')->group(function(){

    // DETTAMI REST -> /movie/{id}
    // Route::get('/movies', 'MovieController@index');
    // Route::get('/movies/{id}', 'MovieController@show');
    // Route::post('/movies', 'MovieController@store');
    // Route::put('/movies/{id}', 'MovieController@update');
    // Route::delete('/movies/{id}', 'MovieController@destroy');

/*rotta per filtrare le ricerche con ajax*/
Route::get('/index', 'FilterAjaxController@index');


});
