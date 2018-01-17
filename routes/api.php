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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

//get navigation
Route::get('/api/v1/banner/{id}/navigation', 'Api\V1\ApiController@getNavigation');
//get files in folder : query parameter (boolean)isWeek e.g. ?isWeek=false
Route::get('/api/v1/folder/{id}', 'Api\V1\ApiController@getDocumentsInFolder');
//get document by id
Route::get('/api/v1/document/{id}', 'Api\V1\ApiController@getDocumentById');
//get recent documents
Route::get('/api/v1/banner/{id}/document/recent/{days}', 'Api\V1\ApiController@getRecentDocuments');
//get all douments in a folder
Route::get('/api/v1/folder/{id}/archived', 'Api\V1\ApiController@getArchivedDocuments');

Route::get('/api/banners', 'StoreApi\StoreApiController@getAllBanners');
Route::get('/api/banner/{id}/stores', 'StoreApi\StoreApiController@getStoresByBannerid');