<?php

//MANAGER DASHBOARD
Route::get('/manager', ['uses' => 'ManagerDashboard\ManagerDashboardController@index']);
Route::get('/manager/dashboard', ['uses' => 'ManagerDashboard\ManagerDashboardController@index']);

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


//library
Route::get('/manager/document', array('uses' => 'Document\LibraryManagerController@index'));
Route::get('/manager/folder/{folder_id}', 'Document\FolderManagerController@show');