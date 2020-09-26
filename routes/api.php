<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/product', 'ProductController@index')->name('product.index');
    Route::post('/product', 'ProductController@store')->name('product.store');
    Route::patch('/product/{product}/update', 'ProductController@update')->name('product.update');
    Route::patch('/product/{product}/upload', 'ProductController@upload')->name('product.upload');
    Route::delete('/product/{product}', 'ProductController@destroy')->name('product.destroy');
    Route::get('/product/{product}', 'ProductController@show')->name('product.show');

    Route::get('/myProducts', 'UserProductsController@index')->name('userProducts.index');
    Route::post('/myProducts', 'UserProductsController@store')->name('userProducts.store');
    Route::delete('/myProducts', 'UserProductsController@destroy')->name('userProducts.destroy');
});
