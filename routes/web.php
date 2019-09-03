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
    return redirect()->route('home');
});

Auth::routes();

Route::middleware('auth')->prefix('admin')->group(function(){
    Route::resource('/house', 'HouseController');
});


Route::get('/home', 'HomeController@index')->name('home');
/*nella rotta passiamo due parametri slug/id*/
Route::get('/house-details/{slug}/{id}', 'HomeController@detailsHouseHome')->name('house_details');

