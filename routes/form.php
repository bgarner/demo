<?php

Route::get('/form', 'Form\FormListAdminController@index');
Route::resource('/form/productrequest', 'Form\ProductRequestFormAdminController')->middleware(['formaccess']);
Route::get('/form/productrequestform/log/{id}', 'Form\FormLogController@show');


Route::resource('/form/group', 'Form\ProductRequest\GroupAdminController');