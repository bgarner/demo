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

Route::pattern('storeno', '^([A-Z]?[0-9]{4})$');
Route::pattern('id', '[0-9]+');

//STORE SELECTOR
Route::get('/', 'StoreSelectorController@index');

//DASHBOARD
Route::get('/{storeno}', array('uses' => 'Dashboard\DashboardController@index'));

//DOCUMENTS
Route::get('/{storeno}/document', array('uses' => 'Document\DocumentController@index'));

//FOLDER - SHOW CONTENT
Route::get('/{storeno}/folder/{id}', ['uses' => 'Document\FolderController@show']);

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

//TOOLS
Route::get('/{storeno}/tools/boxingday', array('uses' => 'Tools\BlackFridayController@index'));
Route::post('/getFlyerBoxes', 'Tools\FlyerPageSelectionController@show');
Route::post('/getFlyerBoxData', 'Tools\FlyerBoxSelectionController@show');


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

//FEATURES
Route::get('/{storeno}/feature/show/{id}', 'Feature\FeatureController@show');

//ALERTS
Route::get('/{storeno}/alerts', array('uses' => 'Alert\AlertController@index'));

//URGENT NOTICES
Route::get('/{storeno}/urgentnotice', array('uses' => 'UrgentNotice\UrgentNoticeController@index'));
Route::get('/{storeno}/urgentnotice/show/{id}', array('uses' => 'UrgentNotice\UrgentNoticeController@show'));

//Search
//Route::post('/{storeno}/search', array('uses' => 'Search\SearchController@index'));
Route::get('/{storeno}/search', array('uses' => 'Search\SearchController@index'));

//BUG REPORTER
Route::post('/bugreport', 'BugReport\BugReportController@store');

//ANALYTICS
Route::post('/clicktrack', 'Analytics\AnalyticsController@store');

//Authentication Routes
// Route::get('/admin/login', 'Auth\AuthController@getLogin');
// Route::post('/admin/login', 'Auth\AuthController@postLogin');
// Route::get('/admin/logout', 'Auth\AuthController@getLogout');

//Registration Routes
// Route::get('/admin/register', 'Auth\AuthController@getRegister');
// Route::post('/admin/register', 'Auth\AuthController@postRegister');
// Route::get('/activate/{activation_code}', 'Auth\AuthController@activateAccount');
// Route::get('/approve/{activation_code}', 'Auth\AuthController@approveAccount');


//Password reset routes
// Route::controllers([
// 	'password' => 'Auth\PasswordController',
// ]);


//list of admin functions
// Route::get('/admin', function(){
// //	return view('admin.index');
// });

Route::get('/admin',  ['middleware' => 'admin.auth', 'uses' =>'AdminController@index' ] );

/* Admin Routes Begin 	*/

//admin home
Route::get('/admin/home',  ['middleware' => 'admin.auth', 'uses' =>'AdminController@index' ] );

//FILES
Route::get('/admin/document/add-meta-data', 'Document\DocumentAdminController@showMetaDataForm');
Route::post('/admin/document/add-meta-data', 'Document\DocumentAdminController@updateMetaData');
Route::get('/admin/document/manager',  ['middleware' => 'admin.auth', 'uses' =>'Document\DocumentManagerController@index' ] );

Route::resource('/admin/document', 'Document\DocumentAdminController');

//FOLDERS
Route::resource('/admin/folder', 'Document\FolderAdminController');

//PACKAGES
Route::resource('/admin/package', 'Document\PackageAdminController');
Route::get('/admin/packagedocuments/{package_id}', 'Document\PackagePartialController@getPackageDocumentPartial');
Route::get('/admin/packagefolders/{package_id}', 'Document\PackagePartialController@getPackageFolderPartial');

//FEATURES
Route::resource('/admin/feature', 'Feature\FeatureAdminController');
Route::resource('/admin/feature/thumbnail', 'Feature\FeatureThumbnailAdminController');
Route::resource('/admin/feature/background', 'Feature\FeatureBackgroundAdminController');
Route::resource('/admin/featureOrder', 'Feature\FeatureOrderAdminController');
Route::get('/admin/featuredocuments/{feature_id}', 'Feature\FeatureAdminController@getFeatureDocumentPartial');
Route::get('/admin/featurepackages/{feature_id}', 'Feature\FeatureAdminController@getFeaturePackagePartial');

//Dasboard ADMIN
Route::resource('/admin/dashboard', 'Dashboard\DashboardAdminController');
Route::resource('/admin/dashboardbackground', 'Dashboard\DashboardBackgroundAdminController');

//Communications
Route::resource('/admin/communication', 'Communication\CommunicationAdminController');
Route::resource('/admin/communicationtypes', 'Communication\CommunicationTypesAdminController');
Route::resource('/admin/communicationimages', 'Communication\CommunicationImageController');
Route::get('/admin/communicationdocuments/{communication_id}', 'Communication\CommunicationPartialController@getCommunicationDocumentPartial');

//CALENDAR ADMIN
Route::resource('/admin/calendar', 'Calendar\CalendarAdminController');

//Event Types
Route::resource('/admin/eventtypes', 'Calendar\EventTypesAdminController');

//Tags
Route::resource('/admin/tag', 'Tag\TagAdminController');

//Quicklinks
Route::resource('/admin/quicklink', 'Dashboard\QuicklinksAdminController');

//Urgent Notices
Route::resource('/admin/urgentnotice', 'UrgentNotice\UrgentNoticeAdminController');
Route::get('/admin/urgentnotice-documents/{urgent_notice_id}', 'UrgentNotice\UrgentNoticeAdminController@getDocumentPartial');
Route::get('/admin/urgentnotice-folders/{urgent_notice_id}', 'UrgentNotice\UrgentNoticeAdminController@getFolderPartial');

Route::resource('/admin/alert', 'Alert\AlertAdminController' );
//Users
Route::resource('/admin/user', 'User\UserAdminController');

//Videos
Route::get('/admin/video/add-meta-data', 'Video\VideoAdminController@showMetaDataForm');
Route::post('/admin/video/add-meta-data', 'Video\VideoAdminController@updateMetaData');
Route::get('/admin/video/{video_id}/uploadthumbnail', 'Video\VideoAdminController@uploadThumbnail');
Route::post('/admin/video/{video_id}/storethumbnail', 'Video\VideoAdminController@storeThumbnail');
Route::resource('/admin/video', 'Video\VideoAdminController');
Route::resource('/admin/playlistorder', 'Video\PlaylistVideoOrderController');

//Playlist
Route::resource('/admin/playlist', 'Video\PlaylistAdminController');
Route::get('/admin/playlistvideos/{playlist_id}', 'Video\PlaylistAdminController@getPlaylistVideoPartial');
//Video Tags
Route::resource('/admin/tag', 'Video\TagAdminController');

//Banner selector
Route::resource('/admin/banner' , 'AdminSelectedBannerController');

//Ckeditor Images
Route::resource('/utilities/ckeditorimages', 'Utilities\CkeditorImageController',
					['names' => ['store' => 'utilities.ckeditorimages.store'] ]
				);

//Store Feedback
Route::resource('/admin/feedback' , 'StoreFeedback\FeedbackAdminController');
Route::resource('/admin/feedback/{id}/note' , 'StoreFeedback\NotesAdminController');

//Tasks
Route::resource('/admin/task', 'Task\TaskAdminController');
Route::get('/admin/task/{task_id}/documents', 'Task\TaskDocumentController@show');

//User Groups and Sections
Route::resource('/admin/group', 'Auth\GroupAdminController');
Route::resource('/admin/component', 'Auth\ComponentAdminController');

//User Groups
Route::resource('/admin/group', 'Auth\Group\GroupAdminController');
Route::get('/admin/group/{id}/roles', 'Auth\Group\GroupRoleAdminController@show');

//User Roles
Route::resource('/admin/role', 'Auth\Role\RoleAdminController');
Route::get('/admin/role/{id}/resources', 'Auth\Role\RoleResourceAdminController@show');
// Role Resources
//Components
Route::resource('/admin/component', 'Auth\Component\ComponentAdminController');

//Product Launch
Route::get('/admin/productlaunch', 'Calendar\ProductLaunchAdminController@index');
Route::get('/admin/productlaunch/create', 'Calendar\ProductLaunchAdminController@create');
Route::post('/admin/productlaunch', 'Calendar\ProductLaunchAdminController@store');
Route::get('admin/productlaunch/add-meta-data', 'Calendar\ProductLaunchAdminController@edit');

Auth::routes();

Route::get('/home', 'HomeController@index');
