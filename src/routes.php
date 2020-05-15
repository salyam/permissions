<?php

Route::get('/permissions', '\Salyam\Permissions\Controllers\PermissionController@index');
Route::post('/permissions/store', '\Salyam\Permissions\Controllers\PermissionController@store');
Route::post('/permissions/update/{id}', '\Salyam\Permissions\Controllers\PermissionController@update');
Route::post('/permissions/destroy/{id}', '\Salyam\Permissions\Controllers\PermissionController@destroy');

Route::get('/roles', '\Salyam\Permissions\Controllers\RoleController@index');
Route::post('/roles/store', '\Salyam\Permissions\Controllers\RoleController@store');
Route::post('/roles/update/{id}', '\Salyam\Permissions\Controllers\RoleController@update');
Route::post('/roles/destroy/{id}', '\Salyam\Permissions\Controllers\RoleController@destroy');