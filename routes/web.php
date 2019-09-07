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

Route::prefix('admin')->group(function(){
    Route::resource('/house', 'HouseController');
    /*rotta per vedere le promo*/
    Route::get('/house/promotions/{slug}/{id}', 'HouseController@showPromotions')->name('promotions');
    /* rotta per vedere i messaggi */
    Route::resource('/messages', 'MessageController');
    /* rotta per vedere le statistiche */
    Route::get('/statistics/user/{id}', 'HouseController@showStatistics')->name('show_statistics');
});




/*rotte per i filtri lato php*/
Route::post('/house/search', 'HouseController@search')->name('house.search');

/*rotta per inviare dati mail*/
Route::post('/house/store/mail', 'HomeController@storeMail')->name('store_mail');

Route::get('/home', 'HomeController@index')->name('home');

/*nella rotta passiamo due parametri slug/id*/
Route::get('/house/details/{slug}/{id}', 'HomeController@detailsHouseHome')->name('house_details');

