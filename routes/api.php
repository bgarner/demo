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

Route::get('/api/banners', 'StoreApi\StoreApiController@getAllBanners');
Route::get('/api/banner/{id}/stores', 'StoreApi\StoreApiController@getStoresByBannerid');
Route::get('/api/store/{storeno}', 'StoreApi\StoreApiController@getStoreDetails');

//Dirty Node Scanner
Route::post('/api/v1/scanner/node', 'Scanner\ScannerApiController@show');
Route::post('/api/v1/scanner/cleannode', 'Scanner\ScannerApiController@update');