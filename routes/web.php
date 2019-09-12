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
    /* rotta per eseguire i pagamenti */
    Route::get('/payment/process/{id}/promo/{id_promo}', 'PaymentsController@process')->name('payment.process');
    /* rotta per mostrare la pagina di pagamento */
    Route::get('/payment/house/{id}/promo/{id_promo}', 'HouseController@showPayments')->name('show_payments');
});


/*rotte per i filtri lato php*/
Route::post('/house/search', 'HouseController@search')->name('house.search');
/*rotta per inviare dati mail*/
Route::post('/house/store/mail', 'HomeController@storeMail')->name('store_mail');
/*rotta per la homepage*/
Route::get('/home', 'HomeController@index')->name('home');
/*nella rotta dei dettagli passo due parametri slug/id*/
Route::get('/house/details/{slug}/{id}', 'HomeController@detailsHouseHome')->name('house_details');

