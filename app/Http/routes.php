<?php

//Auth route
Route::group(['middleware'=>'jwt.auth'],function() {
    Route::get('/auth',function(){});
});


// Admin Dash Routes without auth
Route::group(['prefix' => 'admin/dashboard'], function () {
    Route::get('/', 'Admin\DashboardController@index');
});

// Admin Dash Routes with auth
Route::group(['prefix' => 'admin/dashboard', 'middleware' =>['jwt.auth']], function () {
    Route::get('/logout', 'Auth\AuthController@logout');
    Route::get('/accounts', 'Admin\DashboardController@accounts');
    Route::get('/system-notifications', 'Admin\DashboardController@systemNotifications');
    Route::get('/plans', 'Admin\DashboardController@plans');

    /**
     * Plants Routes
     */
    Route::resource('plants', 'Admin\PlantController');
    Route::post('plants/{id}/update', 'Admin\PlantController@update');

    /**
     * Culinary Plants Routes
     */
    Route::resource('culinary-plants', 'Admin\CulinaryPlantController');
    Route::post('culinary-plants/{id}/update', 'Admin\CulinaryPlantController@update');

    /**
     * Pests Routes
     */
    Route::resource('pests','Admin\PestController');
    Route::post('pests/{id}/update', 'Admin\PestController@update');

    /**
     * Procedure Routes
     */
    Route::resource('procedures', 'Admin\ProcedureController');
    Route::post('procedures/{id}/update', 'Admin\ProcedureController@update');

    /**
     * Alert Routes
     */
    Route::resource('alerts', 'Admin\AlertController');
    Route::post('alerts/{id}/update', 'Admin\AlertController@update');

    /**
     * Categories Routes
     */
    Route::resource('categories', 'Admin\CategoryController');


    /**
     * Subcategories Routes
     */
    Route::resource('subcategories', 'Admin\SubcategoryController');

    /**
     * Sponsors Routes
     */
    Route::resource('sponsors', 'Admin\SponsorController');

    /**
     * Journal Routes;
     */
    Route::get('journals', 'Admin\JournalController@index');

    /**
     * Dashboard Sidebar Routes
     */
    Route::get('/pages', 'Admin\DashboardController@websitePages');
    Route::get('/links', 'Admin\DashboardController@links');
    Route::get('/user-suggestions', 'Admin\DashboardController@userSuggestions');
    Route::get('/whats-this', 'Admin\DashboardController@whatsThis');
    Route::get('/general-messages', 'Admin\DashboardController@generalMessages');
    Route::get('/payment-connection', 'Admin\DashboardController@paymentConnection');
    Route::get('/apis-connection', 'Admin\DashboardController@apisConnection');
    Route::get('/profile', 'Admin\DashboardController@profile');
    Route::get('/settings', 'Admin\DashboardController@settings');
    Route::get('/logout', 'Auth\AuthController@logout');
    Route::get('/system-notifications','Admin\NotificationController@index');

    /**
     * Users Routes
     */
    Route::resource('users','Admin\UserController');

    /*
     * Profile Routes
     */
    Route::resource('profiles','Admin\ProfileController');

    /*
     * Settings Routes
     */
    Route::resource('settings','Admin\SettingsController');

    /*
     * Payment Routes
     */
    Route::resource('payments','Admin\PaymentController');

    /*
     * Glossary Terms routes
     */
    Route::resource('glossary','Admin\GlossaryController');

});

/**
 * Twitter Typeahead Routes
 */
Route::group(['prefix' => 'admin/dashboard', 'namespace' => 'Admin\Searches', 'middleware' => ['web']], function () {

    Route::get('search/plants', 'SearchPlantsController@search');

    Route::get('search/procedures', 'SearchProceduresController@search');

    Route::get('search/pests', 'SearchPestsController@search');

});

// User Dash Routes
Route::group(['prefix' => 'user/dashboard', 'namespace' => 'User', 'middleware' =>['jwt.auth']], function () {
    Route::get('/', 'DashboardController@index');
});

// Web App Routes that don't authenticate
Route::get('/','HomeController@index');
Route::post('/login', 'Auth\AuthController@postLogin');
Route::get('login','Auth\AuthController@showLoginForm');
Route::get('admin/login', 'Auth\AuthController@showLoginForm');
Route::post('admin/login', 'Auth\AuthController@postLogin');

Route::post('/password/email', 'Auth\PasswordController@sendResetLinkEmail');
Route::post('password/reset', 'Auth\PasswordController@reset');
Route::get('/password/reset/{token?}', 'Auth\PasswordController@showResetForm');
Route::get('/register', 'Auth\AuthController@showRegistrationForm');
Route::post('/register', 'Auth\AuthController@register');

// Api Routes
Route::group(['prefix' => 'api/v1', 'namespace' => 'Api\V1',], function() {

});
