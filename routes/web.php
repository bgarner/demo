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
Auth::routes();
Route::pattern('storeno', '^([A-Z]?[0-9]{4})$');
Route::pattern('id', '[0-9]+');

//STORE SELECTOR
Route::get('/', 'StoreSelectorController@index');

//ALERTS
Route::get('/{storeno}/alerts', array('uses' => 'Alert\AlertController@index'));

//ANALYTICS
Route::post('/clicktrack', 'Analytics\AnalyticsController@store');

//BUGREPORTER
Route::post('/bugreport', 'BugReport\BugReportController@store');

//CALENDAR
Route::get('/{storeno}/calendar', array('uses' => 'Calendar\CalendarController@index'));
Route::get('/{storeno}/calendar/listevents/{yearMonth}', array('uses' => 'Calendar\CalendarController@getListofEventsByStoreAndMonth'));
Route::get('/{storeno}/calendar/eventlistpartial/{yearMonth}', 'Calendar\CalendarController@getEventListPartial');
Route::get('/{storeno}/calendar/productlaunch', array('uses'=> 'Calendar\ProductLaunchController@index'));

//COMMUNICATIONS
Route::get('/{storeno}/communication', array('uses' => 'Communication\CommunicationController@index'));
Route::get('/{storeno}/communication/show/{id}', 'Communication\CommunicationController@show');
Route::resource('/communication', 'Communication\CommunicationTargetController');

//COMMUNITY
Route::get('/{storeno}/community', array('uses' => 'Community\CommunityController@index'));
Route::resource('/savedonation', 'Community\CommunityFundController');

//DASHBOARD
Route::get('/{storeno}', array('uses' => 'Dashboard\DashboardController@index'));

//DOCUMENTS
Route::get('/{storeno}/document', array('uses' => 'Document\DocumentController@index'));

//FEATURES
Route::get('/{storeno}/feature/show/{id}', 'Feature\FeatureController@show');

//FOLDER - SHOW CONTENT
Route::get('/{storeno}/folder/{id}', ['uses' => 'Document\FolderController@show']);

//SEARCH
//Route::post('/{storeno}/search', array('uses' => 'Search\SearchController@index'));
Route::get('/{storeno}/search', array('uses' => 'Search\SearchController@index'));

//TOOLS
Route::get('/{storeno}/tools/boxingday', array('uses' => 'Tools\BlackFridayController@index'));
Route::post('/getFlyerBoxes', 'Tools\FlyerPageSelectionController@show');
Route::post('/getFlyerBoxData', 'Tools\FlyerBoxSelectionController@show');

//URGENT NOTICES
Route::get('/{storeno}/urgentnotice', array('uses' => 'UrgentNotice\UrgentNoticeController@index'));
Route::get('/{storeno}/urgentnotice/show/{id}', array('uses' => 'UrgentNotice\UrgentNoticeController@show'));

//VIDEO
Route::get('/{storeno}/video', array('uses' => 'Video\VideoController@index'));
Route::get('/{storeno}/video/popular', array('uses' => 'Video\VideoController@mostViewed'));
Route::get('/{storeno}/video/latest', array('uses' => 'Video\VideoController@mostRecent'));
Route::get('/{storeno}/video/liked', array('uses' => 'Video\VideoController@mostLiked'));
Route::get('/{storeno}/video/playlists', array('uses' => 'Video\VideoController@allPlaylists'));
Route::get('/{storeno}/video/watch/{id}', array('uses' => 'Video\VideoController@show'));
Route::get('/{storeno}/video/playlist/{id}', array('uses' => 'Video\VideoController@showPlaylist'));
Route::get('/{storeno}/video/tag/{tag}', array('uses' => 'Video\VideoController@showTag'));
Route::post('/videocount', 'Video\VideoViewCountController@update');
Route::post('/videolike', 'Video\LikeController@update');
Route::post('/videodislike', 'Video\DislikeController@update');


//list of admin functions
// Route::get('/admin', function(){
// //	return view('admin.index');
// });
