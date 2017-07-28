<?php

//MANAGER DASHBOARD
Route::get('/manager', ['uses' => 'ManagerDashboard\ManagerDashboardController@index']);
Route::get('/manager/dashboard', ['uses' => 'ManagerDashboard\ManagerDashboardController@index']);
Route::get('/manager/avp-dashboard', ['uses' => 'ManagerDashboard\ManagerDashboardController@avp']);
Route::get('/manager/dm-dashboard', ['uses' => 'ManagerDashboard\ManagerDashboardController@dm']);

//MANAGER TASKS
Route::resource('/manager/task', 'Task\TaskManagerController');

//Store View
Route::get('/manager/store/{store}', 'ManagerDashboard\StoreProfileController@show');