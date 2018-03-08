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
// Route::get('/{storeno}/calendar/listevents/{yearMonth}', array('uses' => 'Calendar\CalendarController@getListofEventsByStoreAndMonth'));
Route::get('/{storeno}/calendar/eventlistpartial/{yearMonth}', 'Calendar\CalendarController@getEventListPartial');
Route::get('/{storeno}/calendar/productlaunch', array('uses'=> 'Calendar\ProductLaunchController@index'));

//COMMUNICATIONS
Route::get('/{storeno}/communication', array('uses' => 'Communication\CommunicationController@index'));
Route::get('/{storeno}/communication/show/{id}', 'Communication\CommunicationController@show');

//COMMUNITY
Route::get('/{storeno}/community', array('uses' => 'Community\CommunityController@index'));
Route::resource('/savedonation', 'Community\CommunityFundController');

//DASHBOARD
Route::get('/{storeno}', array('uses' => 'Dashboard\DashboardController@index'));

//DOCUMENTS
Route::get('/{storeno}/document', array('uses' => 'Document\DocumentController@index'));

//FEATURES
Route::get('/{storeno}/feature/show/{id}', 'Feature\FeatureController@show');

//FLYER
Route::get('/{storeno}/flyer', array('uses' => 'Flyer\FlyerController@index'));
Route::get('/{storeno}/flyer/{flyer_id}', array('uses' => 'Flyer\FlyerController@show'));

//FOLDER - SHOW CONTENT
Route::get('/{storeno}/folder/{id}', ['uses' => 'Document\FolderController@show']);

//SEARCH
//Route::post('/{storeno}/search', array('uses' => 'Search\SearchController@index'));
Route::get('/{storeno}/search', array('uses' => 'Search\SearchController@index'));

//TAGS
Route::get('/{storeno}/tag/{tag}', 'Tag\TagController@index');

//TASKS
Route::get('/{storeno}/task', 'Task\TaskController@index');
Route::get('/{storeno}/tasklist/{id}', 'Task\TasklistController@index');
Route::patch('/{storeno}/task/{id}', 'Task\TaskController@update');
Route::patch('/{storeno}/tasklist/{id}/task/{taskId}', 'Task\TasklistController@update');


//TOOLS
Route::get('/{storeno}/tools/boxingday', array('uses' => 'Tools\BlackFridayController@index'));
Route::post('/getFlyerBoxes', 'Tools\FlyerPageSelectionController@show');
Route::post('/getFlyerBoxData', 'Tools\FlyerBoxSelectionController@show');
Route::get('/{storeno}/tools/boxingday', array('uses' => 'Tools\BlackFridayController@index'));
Route::get('/{storeno}/tools/bikecount', array('uses' => 'Tools\BikeCountController@index'));
Route::get('/{storeno}/tools/flashsale', array('uses' => 'Tools\FlashSaleController@index'));
Route::get('/{storeno}/tools/fwinitials', array('uses' => 'Tools\FootwearInitialsController@index'));
Route::get('/{storeno}/tools/sginitials', array('uses' => 'Tools\SoftgoodsInitialsController@index'));
Route::get('/{storeno}/tools/hginitials', array('uses' => 'Tools\HardgoodsInitialsController@index'));
Route::get('/{storeno}/tools/lcinitials', array('uses' => 'Tools\LicensedInitialsController@index'));
Route::post('/getFlyerBoxes', 'Tools\FlyerPageSelectionController@show');
Route::post('/getFlyerBoxData', 'Tools\FlyerBoxSelectionController@show');
Route::get('/{storeno}/tools/dirtynodes', array('uses' => 'Tools\DirtyNodesController@index'));
Route::patch('/{storeno}/tools/dirtynodes/clean', array('uses' => 'Tools\DirtyNodesController@update'));
Route::get('/{storeno}/tools/productdelivery/{division}', array('uses' => 'Tools\ProductDeliveryController@index'));
Route::get('/tools/productdelivery/departments', array('uses' => 'Tools\ProductDeliveryController@getDepartments'));
Route::get('/tools/productdelivery/subdepartments', array('uses' => 'Tools\ProductDeliveryController@getSubDepartments'));
Route::get('/tools/productdelivery/classes', array('uses' => 'Tools\ProductDeliveryController@getClasses'));
Route::get('/tools/productdelivery/brands', array('uses' => 'Tools\ProductDeliveryController@getBrands'));
Route::get('/tools/productdelivery/styles', array('uses' => 'Tools\ProductDeliveryController@getStyles'));

//TRAINING
Route::get('/{storeno}/training', array('uses' => 'Training\TrainingController@index'));

//URGENT NOTICES
Route::get('/{storeno}/urgentnotice', array('uses' => 'UrgentNotice\UrgentNoticeController@index'));
Route::get('/{storeno}/urgentnotice/show/{id}', array('uses' => 'UrgentNotice\UrgentNoticeController@show'));

//VIDEO
Route::get('/{storeno}/video', array('uses' => 'Video\VideoController@index'));
Route::get('/{storeno}/video/watch/{id}', array('uses' => 'Video\VideoController@show'));

Route::get('/{storeno}/video/popular', array('uses' => 'Video\MostViewedVideoController'));
Route::get('/{storeno}/video/latest', array('uses' => 'Video\MostRecentVideoController'));
Route::get('/{storeno}/video/liked', array('uses' => 'Video\MostLikedVideoController'));

Route::get('/{storeno}/video/playlists', array('uses' => 'Video\PlaylistController@index'));
Route::get('/{storeno}/video/playlist/{id}', array('uses' => 'Video\PlaylistController@show'));

Route::get('/{storeno}/video/tag/{tag}', array('uses' => 'Video\VideoController@showTag'));
Route::post('/videocount', 'Video\VideoViewCountController@update');
Route::post('/videolike', 'Video\LikeController@update');
Route::post('/videodislike', 'Video\DislikeController@update');

Route::post('/setLanguage', 'Locale\LocaleController@setLanguage');
//list of admin functions
// Route::get('/admin', function(){
// //	return view('admin.index');
// });

Route::resource('/{storeno}/forms/', 'Form\FormListController');
Route::resource('/{storeno}/forms/storefeedback/', 'Form\StoreFeedbackFormController');
