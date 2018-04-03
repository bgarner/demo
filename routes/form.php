<?php

Route::get('/form', 'Form\FormListAdminController@index');
Route::resource('/form/productrequest', 'Form\ProductRequestFormAdminController')->middleware(['formaccess']);
Route::get('/form/productrequestform/log/{id}', 'Form\FormLogController@show');

//Form Groups
Route::resource('/form/group', 'Form\ProductRequest\GroupAdminController');

//Form Users
Route::resource('/form/user', 'Form\ProductRequest\UserAdminController');
Route::get('/form/{id}/users', 'Form\ProductRequest\FormUserAdminController@show');