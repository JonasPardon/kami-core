<?php

Route::get('/admin/login', 'JonasPardon\KamiCore\Controllers\AuthController@showLogin')->name('login');
Route::post('/admin/login', 'JonasPardon\KamiCore\Controllers\AuthController@submitLogin');

Route::group(['middleware' => 'auth:web'], function() {
    Route::get('/admin', 'JonasPardon\KamiCore\Controllers\HomeController@index')->name('admin.home');

    Route::get('/admin/auth/users', 'JonasPardon\KamiCore\Controllers\AuthController@usersIndex');
    Route::get('/admin/auth/users/new', 'JonasPardon\KamiCore\Controllers\AuthController@usersCreate');
    Route::get('/admin/auth/users/{id}', 'JonasPardon\KamiCore\Controllers\AuthController@usersShow');

    Route::get('/admin/pages', 'JonasPardon\KamiCore\Controllers\PageController@index');
    Route::get('/admin/pages/new', 'JonasPardon\KamiCore\Controllers\PageController@create');
    Route::get('/admin/pages/{id}', 'JonasPardon\KamiCore\Controllers\PageController@show');
    Route::post('/admin/pages', 'JonasPardon\KamiCore\Controllers\PageController@store');
    Route::post('/admin/pages/{id}', 'JonasPardon\KamiCore\Controllers\PageController@update');

    Route::get('/admin/media', 'JonasPardon\KamiCore\Controllers\MediaController@index');
    Route::post('/admin/media', 'JonasPardon\KamiCore\Controllers\MediaController@store');

    Route::get('/admin/settings', 'JonasPardon\KamiCore\Controllers\SettingController@index');
    Route::post('/admin/settings', 'JonasPardon\KamiCore\Controllers\SettingController@update');

    Route::post('/admin/preview', 'JonasPardon\KamiCore\Controllers\PreviewController@show');
});

