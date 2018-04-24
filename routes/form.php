<?php

// Route::get('/form', 'Form\FormListAdminController@index');
Route::get('/form', 'Form\ProductRequest\DashboardAdminController@index');
Route::resource('/form/productrequest', 'Form\ProductRequestFormAdminController')->middleware(['formaccess']);
Route::get('/form/productrequestform/log/{id}', 'Form\FormLogController@show');

//Form Groups
Route::resource('/form/group', 'Form\ProductRequest\GroupAdminController');

//Form Users
Route::resource('/form/user', 'Form\ProductRequest\UserAdminController');
Route::get('/form/{id}/users', 'Form\ProductRequest\FormUserAdminController@show');

//Assignments
Route::get('/form/assignment', 'Form\ProductRequest\AssignmentAdminController@index');
Route::patch('/form/assignment/forminstance/{form_instance_id}' , 'Form\ProductRequest\AssignmentAdminController@update');