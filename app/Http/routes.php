<?php

// Admin Dash Routes


use App\GardenRevolution\Repositories\PlantRepository as PlantRepo;

Route::get('allplants', function() {
    $plant = new App\Models\Plant;

    $plantrepo = new PlantRepo($plant);

    return $plantrepo->getAll();
});

Route::group(['middleware' => ['web']], function () {
    Route::get('admin/login', 'Auth\AuthController@showLoginForm');
    Route::post('admin/login', 'Auth\AuthController@postLogin');
});

Route::group(['prefix' => 'admin/dashboard', 'middleware' => ['web']], function () {

    Route::get('/', 'Admin\DashboardController@index');
    Route::get('/accounts', 'Admin\DashboardController@accounts');
    Route::get('/system-notifications', 'Admin\DashboardController@systemNotifications');
    Route::get('/plans', 'Admin\DashboardController@plans');

    /**
     * Plants Routes
     */
    Route::resource('plants', 'Admin\PlantController');

    /**
     * Categories Routes
     */
    Route::resource('categories', 'Admin\CategoryController');

    /**
     * Subcategories Routes
     */
    Route::resource('subcategories', 'Admin\SubcategoryController');

    /**
     * Dashboard Sidebar Routes
     */
    Route::get('/culinary-plants', 'Admin\DashboardController@culinaryPlantLibrary');
    Route::get('/pests', 'Admin\DashboardController@pestLibrary');
    Route::get('/procedures', 'Admin\DashboardController@procedureLibrary');
    Route::get('/pages', 'Admin\DashboardController@websitePages');
    Route::get('/categories', 'Admin\DashboardController@categories');
    Route::get('/journals', 'Admin\DashboardController@journal');
    Route::get('/glossary', 'Admin\DashboardController@glossary');
    Route::get('/links', 'Admin\DashboardController@links');
    Route::get('/user-suggestions', 'Admin\DashboardController@userSuggestions');
    Route::get('/whats-this', 'Admin\DashboardController@whatsThis');
    Route::get('/general-messages', 'Admin\DashboardController@generalMessages');
    Route::get('/payment-connection', 'Admin\DashboardController@paymentConnection');
    Route::get('/apis-connection', 'Admin\DashboardController@apisConnection');
    Route::get('/profile', 'Admin\DashboardController@profile');
    Route::get('/settings', 'Admin\DashboardController@settings');
    Route::get('/logout', 'Auth\AuthController@logout');

    /**
     * Users Routes
     */
    Route::resource('users','Admin\UserController');
    Route::resource('profiles','Admin\ProfileController');

});

// User Dash Routes

Route::group(['prefix' => 'user/dashboard', 'namespace' => 'User', 'middleware' => ['web']], function () {

    Route::get('/', 'DashboardController@index');

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
