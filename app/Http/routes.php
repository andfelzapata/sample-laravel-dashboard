<?php

// Home Route
Route::get('/', function () {

    return view('home');
});

// Application Routes

Route::group(['middleware' => ['web']], function () {
    //
});

// Api Routes
Route::group(['prefix' => 'api/v1', 'namespace' => 'Api\V1',], function() {

});

