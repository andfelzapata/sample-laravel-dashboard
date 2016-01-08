var elixir = require('laravel-elixir');

var gulp   = require('gulp');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

 /*
 * Bower Root
 */
var bower = 'resources/assets/bower/';

/*
 * Assets Root
 */
var root = 'resources/assets/';

/*
 * Utilities Directory
 */
var utils = root  + 'js/utils/';

/**
 * Admin App Source Files
 */
var adminSource = '/adminSrc/';
var adminModels = adminSource  + 'models/';
var adminRouter = adminSource  + 'routers/';
var adminViews  = adminSource  + 'views/';

/**
 * User App Source Files
 */
var userSource = '/userSrc/';
var userModels = userSource  + 'models/';
var userRouter = userSource  + 'routers/';
var userViews  = userSource  + 'views/';


/*
 * Assets Output
 */
var css = 'public/assets/css/';
var js  = 'public/assets/js/';

/*
 *  Vendor output
 */
var bootstrap   = 'public/vendor/bootstrap/';
var jquery 	    = 'public/vendor/jquery/';
var fontawesome = 'public/vendor/fontawesome/';
var backbone    = 'public/vendor/backbone/';
var underscore  = 'public/vendor/underscore/';
var ohsnap      = 'public/vendor/oh-snap/';
var sweetalert  = 'public/vendor/sweetalert/';
var typeahead   = 'public/vendor/typeahead/';
var tablesorter = 'public/vendor/tablesorter';

elixir(function(mix) {


    mix.sass(['admin.scss', 'app.scss','home.css',]);

        // Bootstrap
    mix.copy(bower + 'bootstrap/dist/css/bootstrap.min.css', bootstrap)
        .copy(bower + 'bootstrap/dist/css/bootstrap-theme.min.css', bootstrap)
        .copy(bower + 'bootstrap/dist/js/bootstrap.min.js', bootstrap)
        // jQuery
        .copy(bower + 'jquery/dist/jquery.min.js', jquery)
        // Backbone and Underscore
        .copy(bower + 'backbone/backbone.js', backbone)
        .copy(bower + 'underscore/underscore.js', underscore)
        // Sweetalert
        .copy(bower + 'sweetalert/dist/sweetalert.min.js', sweetalert)
        .copy(bower + 'sweetalert/dist/sweetalert.css', sweetalert)
		// Twitter Typeahead
		.copy(bower + 'typeahead.js/dist/typeahead.bundle.js', typeahead)
        // Table Sorter
        .copy(bower + 'tablesorter/jquery.tablesorter.min.js', tablesorter)
        // Auth functions
        .copy(root + 'js/auth.js', js);

    // Admin dashboard js source.
     mix.scripts([
         utils+'utils.js',
         adminModels,
         adminViews+'views.js',
         adminRouter+'router.js',
         adminSource+'admin.js',] , js+'admin.js');

    // User app js source.
    mix.scripts([
        utils+'utils.js',
        userViews+'views.js',
        userRouter+'router.js',
        userSource+'user.js',] , js+'app.js');
});