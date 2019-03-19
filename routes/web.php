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


Route::group(['prefix'=>'product'],function(){
    Route::get('/','ProductController@index');

    Route::post('/','ProductController@insertProduct');
    
    Route::post('/update/{id}','ProductController@update');
    Route::get('/delete/{id}','ProductController@delete');
    Route::get('/{id}','ProductController@edit');

    
    
});



Route::get('/tes','TesController@create');
Route::get('/edit','TesController@edit');
Route::get('/{any}',function(){
    return view('indexproduct');
})->where('any', '.*');