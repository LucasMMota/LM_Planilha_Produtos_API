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
Route::post('products/{sheetPath}','ProductsController@store');

Route::get('jobStatus', 'ProductsController@checkJobStatus');

Route::get('products', 'ProductsController@index');

Route::get('products/{product}', 'ProductsController@show');

Route::put('products/{product}','ProductsController@update');

Route::delete('products/{product}', 'ProductsController@delete');