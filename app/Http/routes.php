<?php

// Admin Dash Routes

Route::group(['prefix' => 'admin/dashboard', 'middleware' => ['web']], function () {

    Route::get('/', 'Admin\DashboardController@index');

});

// User Dash Routes

Route::group(['prefix' => 'user/dashboard', 'middleware' => ['web']], function () {

    Route::get('/', 'User\DashboardController@index');

});

// Web App Routes
Route::group(['middleware' => 'web'], function () {

    // Home Route
    Route::get('/','HomeController@index');

    Route::post('/login', 'Auth\AuthController@postLogin');
    Route::get('/login', 'Auth\AuthController@showLoginForm');
    Route::get('/logout', 'Auth\AuthController@logout');
    Route::post('/password/email', 'Auth\PasswordController@sendResetLinkEmail');
    Route::post('password/reset', 'Auth\PasswordController@reset');
    Route::get('/password/reset/{token?}', 'Auth\PasswordController@showResetForm');
    Route::get('/register', 'Auth\AuthController@showRegistrationForm');
    Route::post('/register', 'Auth\AuthController@register');

});

// Api Routes
Route::group(['prefix' => 'api/v1', 'namespace' => 'Api\V1',], function() {

});