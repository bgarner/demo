<?php

//MANAGER DASHBOARD
Route::get('/manager', ['uses' => 'ManagerDashboard\ManagerDashboardController@index']);
Route::get('/manager/dashboard', ['uses' => 'ManagerDashboard\ManagerDashboardController@index']);

//Features
Route::get('/manager/feature/show/{id}', 'Feature\FeatureManagerController@show');

//MANAGER TASKS
Route::resource('/manager/task', 'Task\TaskManagerController');

//Store View
Route::get('/manager/store/{store}', 'ManagerDashboard\StoreProfileController@show');

//communication
Route::get('/manager/communication', 'Communication\CommunicationManagerController@index');
Route::get('/manager/communication/show/{id}', 'Communication\CommunicationManagerController@show');

//calendar
Route::get('/manager/calendar', 'Calendar\CalendarManagerController@index');
Route::get('/manager/productlaunch', 'Calendar\ProductLaunchManagerController@index');
Route::get('/manager/calendar/eventlistpartial/{yearmonth}' , 'Calendar\CalendarManagerController@getEventListPartial');

//alert and Urgent Notice
Route::get('/manager/alert', 'Alert\AlertManagerController@index');
Route::get('/manager/urgentnotice', 'UrgentNotice\UrgentNoticeManagerController@index');
Route::get('/manager/urgentnotice/{id}', 'UrgentNotice\UrgentNoticeManagerController@show');


//library
Route::get('/manager/document', array('uses' => 'Document\LibraryManagerController@index'));
Route::get('/manager/folder/{folder_id}', 'Document\FolderManagerController@show');


//Tools
Route::get('/manager/tools/dirtynodes', array('uses' => 'Tools\DirtyNodesManagerController@index'));

//Form
Route::get('/manager/formlist', array('uses' => 'Form\FormListManagerController@index'));
Route::resource('/manager/form/productrequest', 'Form\ProductRequestFormManagerController');

//Report
Route::get('/manager/report/productrequest', 'Report\ProductRequestReportController@index')->middleware('role:Exec');
Route::get('/manager/report/managerlogin', 'Report\ManagerLoginReportController@index')->middleware('role:Exec');