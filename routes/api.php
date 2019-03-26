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

Route::group(['prefix'=>'product'],function(){
    Route::get('/','ProductController@getAlldata');
    Route::post('/','ProductController@insertProduct');
    Route::post('/update/{id}','ProductController@update');
    Route::delete('/delete/{id}','ProductController@delete');
    Route::get('/find/{id}','ProductController@edit');
    
});

Route::group(['prefix'=>'customer'],function(){
    Route::get('/','CustomerController@getData');
    Route::post('/','CustomerController@insertCustomer');
    Route::post('/update/{id}','CustomerController@update');
    Route::delete('/delete/{id}','CustomerController@delete');
    Route::get('/find/{id}','CustomerController@edit');
    
});

Route::group(['prefix'=>'invoices'],function(){
    Route::get('/','InvoiceController@getData');
    Route::post('/', 'InvoiceController@save')->name('invoice.store');
    
    Route::post('/update/{id}','InvoiceController@update');
    Route::delete('/delete/{id}','InvoiceController@delete');
    Route::get('/find/{id}','InvoiceController@edit');
    Route::get('/new', 'InvoiceController@create')->name('invoice.create');
    
});
