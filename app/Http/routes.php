<?php

// Home Route
Route::get('/', function () {

    return view('home');
});

// Admin Dash Routes

Route::group(['prefix' => 'admin/dashboard', 'middleware' => ['web']], function () {
    
	Route::get('/', 'Admin\DashboardController@index');


});

// User Dash Routes

Route::group(['prefix' => 'user/dashboard', 'middleware' => ['web']], function () {
    
	Route::get('/', 'User\DashboardController@index');


});

// Api Routes
Route::group(['prefix' => 'api/v1', 'namespace' => 'Api\V1',], function() {

});

