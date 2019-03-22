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


Route::get('/halaman/{page?}', function ($page=1) {
    return "Halo, kamu sedang mengakses halaman ".$page;
});
//route agar url berdasar nama, lihat modelnya juga
Route::get('produk/{produk}',function(\App\Product $produk){
    dd($produk);
    return $produk->title." ".$produk->price." ".$produk->stock;
});
//route agar url berdasar nama tapi ke controller dulu, lihat modelnya juga
Route::get('produk/nama/{produk}','TesController@nama');
Route::get('cek','TesController@cek');
Route::get('/tes','TesController@create');
Route::get('/tes/back','TesController@backing');
Route::get('/edit','TesController@edit');
Route::get('/{any}',function(){
    return view('indexproduct');
})->where('any', '.*');