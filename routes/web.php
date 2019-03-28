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

Route::group(['prefix'=>'customer'],function(){
    Route::get('/','CustomerController@getData');
    Route::post('/','CustomerController@insertCustomer');
    
    Route::post('/update/{id}','CustomerController@update');
    Route::get('/delete/{id}','CustomerController@delete');
    Route::get('/{id}','CustomerController@edit');
});

Route::group(['prefix'=>'invoice'],function(){
    Route::get('/','InvoiceController@getData');
    Route::post('/', 'InvoiceController@save')->name('invoice.store');
    Route::get('/listinvoice','InvoiceController@get_invoice_detail');
    Route::get('/{id}','InvoiceController@edit');
    Route::get('/update/{id}','InvoiceController@listBarang');
    Route::post('/update/{id}','InvoiceController@update');
    Route::get('/delete/{id}','InvoiceController@deletebarang');
    
    
    
    Route::get('/new', 'InvoiceController@create')->name('invoice.create');
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
Route::get('cek/customer/{id}','TesController@caricustomer');
Route::get('/tes','TesController@create');
Route::get('/tes/back','TesController@backing');
Route::get('/edit','TesController@edit');
Route::get('/{any}',function(){
    return view('indexproduct');
})->where('any', '.*');