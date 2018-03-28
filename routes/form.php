<?php

Route::get('/form', 'Form\FormListAdminController@index');
Route::resource('/form/storefeedback', 'Form\StoreFeedbackFormAdminController')->middleware(['formaccess']);
Route::get('/form/storefeedbackform/log/{id}', 'Form\FormLogController@show');
