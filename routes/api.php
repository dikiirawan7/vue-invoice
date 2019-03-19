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
