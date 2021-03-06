<?php
/* Admin Routes Begin 	*/
//Route::get('/admin',  ['middleware' => 'admin.auth', 'uses' =>'AdminController@index' ] );
Route::get('/admin', 'AdminController@index');
Route::get('/admin/videoanalytics', 'Analytics\AnalyticsAdminController@index');
Route::get('/admin/paginatedvideos', 'Analytics\AnalyticsAdminController@getVideoAnalyticsByPage');

// Route::get('/admin/loginas/{id}', function($id) {
//     Auth::loginUsingId($id);
//     return redirect('/login');
// });

Route::get('/admin/loginas/{id}', 'Auth\LoginAsUserController@index');

//admin home
//Route::get('/admin/home',  ['middleware' => 'admin.auth', 'uses' =>'AdminController@index' ] );
Route::get('/admin/home', 'AdminController@index');

//FILES
Route::get('/admin/document/add-meta-data', 'Document\DocumentAdminController@showMetaDataForm');
Route::post('/admin/document/add-meta-data', 'Document\DocumentAdminController@updateMetaData');
Route::get('/admin/document/manager',  ['middleware' => 'admin.auth', 'uses' =>'Document\LibraryAdminController@index' ] );

Route::resource('/admin/document', 'Document\DocumentAdminController');
Route::post('/admin/document/{id}', 'Document\DocumentAdminController@replaceDocument');
Route::resource('/admin/documentfolder', 'Document\DocumentFolderAdminController');

//FOLDERS
Route::resource('/admin/folder', 'Document\FolderAdminController');

//FORMS
Route::get('/admin/formlist', 'Form\FormListAdminController@index');
Route::resource('/admin/form/productrequest', 'Form\ProductRequestFormAdminController')->middleware(['formaccess']);
Route::get('/admin/forms/productrequestform/log/{id}', 'Form\FormLogController@show');

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
Route::get('/admin/featureflyers/{feature_id}', 'Feature\FeatureAdminController@getFeatureFlyerPartial');

//FLYER
Route::resource('/admin/flyer', 'Flyer\FlyerAdminController');
Route::resource('/admin/flyeritem', 'Flyer\FlyerItemAdminController');

//Dasboard ADMIN
Route::resource('/admin/dashboard', 'Dashboard\DashboardAdminController');
Route::resource('/admin/dashboardbackground', 'Dashboard\DashboardBackgroundAdminController');

//Communications
Route::resource('/admin/communication', 'Communication\CommunicationAdminController');
Route::resource('/admin/communicationtypes', 'Communication\CommunicationTypesAdminController');
Route::post('/admin/target/communicationtypes', 'Communication\CommunicationTypesAdminController@getCommunicationTypesByTarget');
Route::resource('/admin/communicationimages', 'Communication\CommunicationImageController');
Route::get('/admin/communicationdocuments/{communication_id}', 'Communication\CommunicationPartialController@getCommunicationDocumentPartial');

//CALENDAR ADMIN
Route::resource('/admin/calendar', 'Calendar\CalendarAdminController');

//Event Types
Route::resource('/admin/eventtypes', 'Calendar\EventTypesAdminController');
Route::post('/admin/target/eventtypes', 'Calendar\EventTypesAdminController@getEventTypesByTarget');

//Tags
Route::resource('/admin/tag', 'Tag\TagAdminController');

//Quicklinks
Route::resource('/admin/quicklink', 'Dashboard\QuicklinksAdminController');

//Urgent Notices
Route::resource('/admin/urgentnotice', 'UrgentNotice\UrgentNoticeAdminController');
Route::get('/admin/urgentnotice-documents/{urgent_notice_id}', 'UrgentNotice\UrgentNoticeAdminController@getDocumentPartial');
Route::get('/admin/urgentnotice-folders/{urgent_notice_id}', 'UrgentNotice\UrgentNoticeAdminController@getFolderPartial');

Route::resource('/admin/alert', 'Alert\AlertAdminController' );
Route::resource('/admin/alerttypes', 'Alert\AlertTypesAdminController' );
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

//Content Tags
Route::get('/admin/videotag/{video_id}', 'Video\VideoTagController@show');
Route::post('/admin/videotag', 'Video\VideoTagController@store');
Route::get('/admin/playlisttag/{playlist_id}', 'Video\PlaylistTagController@show');
Route::post('/admin/playlisttag', 'Video\PlaylistTagController@store');
Route::get('/admin/documenttag/{document_id}', 'Document\DocumentTagController@show');
Route::post('/admin/documenttag', 'Document\DocumentTagController@store');
Route::get('/admin/communicationtag/{communication_id}', 'Communication\CommunicationTagController@show');
Route::post('/admin/communicationtag', 'Communication\CommunicationTagController@store');

//Banner selector
Route::resource('/admin/banner' , 'AdminSelectedBannerController');

//Batch File Uploader
Route::resource('/admin/batchfileupload', 'Utilities\BatchFileUploadController');
Route::resource('/admin/batchvideoupload', 'Utilities\BatchVideoUploadController');
Route::resource('/admin/batchthumbnailupload', 'Utilities\BatchThumbnailUploadController');

//Ckeditor Images
Route::resource('/utilities/ckeditorimages', 'Utilities\CkeditorImageController',
					['names' => ['store' => 'utilities.ckeditorimages.store'] ]
				);

//Store Feedback
Route::resource('/admin/feedback' , 'StoreFeedback\FeedbackAdminController');
Route::resource('/admin/feedback/{id}/note' , 'StoreFeedback\NotesAdminController');

//Tasks
Route::resource('/admin/task', 'Task\TaskAdminController');
Route::resource('/admin/tasklist', 'Task\TasklistAdminController');
Route::get('/admin/task/{task_id}/documents', 'Task\TaskDocumentController@show');

//User Groups
// Route::resource('/admin/group', 'Auth\GroupAdminController');
// Route::resource('/admin/component', 'Auth\ComponentAdminController');

//User Groups
Route::get('/admin/group', 'Auth\Group\GroupAdminController@index');
Route::get('/admin/group/{id}/roles', 'Auth\Group\GroupRoleAdminController@show');

//User Roles
Route::resource('/admin/role', 'Auth\Role\RoleAdminController');
Route::get('/admin/role/{id}/resources', 'Auth\Role\RoleResourceAdminController@show');
// Role Resources
//Components
Route::resource('/admin/component', 'Auth\Component\ComponentAdminController');

//Resources
Route::resource('/admin/resource', 'Auth\Resource\ResourceAdminController');
Route::get('admin/resourcetype/{id}', 'Auth\Resource\ResourceTypeAdminController@show');

//Product Launch
Route::get('/admin/productlaunch', 'Calendar\ProductLaunchAdminController@index');
Route::get('/admin/productlaunch/create', 'Calendar\ProductLaunchAdminController@create');
Route::post('/admin/productlaunch', 'Calendar\ProductLaunchAdminController@store');

//Custom Store Groups
Route::resource('/admin/storegroup', 'Tools\CustomStoreGroupAdminController');

//Store Components
Route::resource('/admin/storecomponent', 'StoreComponent\StoreComponentAdminController');
Route::patch('/admin/subcomponent/{id}', 'StoreComponent\SubComponentAdminController@update');

//Dirty Nodes
Route::get('/admin/dirtynodes', 'Tools\DirtyNodesAdminController@index');
Route::get('/admin/dirtynodes/report', 'Tools\DirtyNodesAdminController@show');


//Store Structure
Route::resource('/admin/store', 'StoreApi\StoreAdminController');
Route::resource('/admin/district', 'StoreApi\DistrictAdminController');
Route::resource('/admin/region', 'StoreApi\RegionAdminController');
Route::resource('/admin/districtstore', 'StoreApi\DistrictStoreAdminController');
Route::resource('/admin/regiondistrict', 'StoreApi\RegionDistrictAdminController');
Route::resource('/admin/storestructure', 'StoreApi\StoreStructureAdminController');
