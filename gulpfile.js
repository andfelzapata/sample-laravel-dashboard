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
var bootstrap    = 'public/vendor/bootstrap/';
var bsswitch     = 'public/vendor/bootstrap-switch/'
var jquery 	     = 'public/vendor/jquery/';
var fontawesome  = 'public/vendor/font-awesome/';
var backbone     = 'public/vendor/backbone/';
var underscore   = 'public/vendor/underscore/';
var ohsnap       = 'public/vendor/oh-snap/';
var require      = 'public/vendor/require/';
var requireText  = 'public/vendor/requireText/';
var sweetalert   = 'public/vendor/sweetalert/';
var typeahead    = 'public/vendor/typeahead/';
var handlebars   = 'public/vendor/handlebars/';
var hbs_layouts  = 'public/vendor/hbs-layouts/';
var tablesorter  = 'public/vendor/tablesorter';
var magicsuggest = 'public/vendor/magicsuggest';
var selectize    = 'public/vendor/selectize';
var stripe       = 'public/vendor/stripe';
var normalize    = 'public/vendor/normalize/';
var dropzone     = 'public/vendor/dropzone';

elixir(function(mix) {


    mix.sass(['app.scss'], css);

    /**
     * Front End Application Styles
     */
    mix.sass(['garden-revolution.scss'], css+'/garden-revolution');

        // Bootstrap
    mix.copy(bower + 'bootstrap/dist/css/bootstrap.min.css', bootstrap)
        .copy(bower + 'bootstrap/dist/css/bootstrap-theme.min.css', bootstrap)
        .copy(bower + 'bootstrap/dist/js/bootstrap.min.js', bootstrap)
        // Bootstrap Switch
        .copy(bower + 'bootstrap-switch/dist/css/bootstrap3/bootstrap-switch.min.css', bsswitch)
        .copy(bower + 'bootstrap-switch/dist/js/bootstrap-switch.min.js', bsswitch)
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
        // Handlebars
        .copy(bower + 'handlebars/handlebars.js', handlebars)
        // Handlebars Layouts
        .copy(bower + 'handlebars-layouts/dist/handlebars-layouts.js', hbs_layouts)
        // Table Sorter
        .copy(bower + 'tablesorter/jquery.tablesorter.min.js', tablesorter)
        // Magicsuggest
        .copy(bower + 'magicsuggest/magicsuggest-min.js', magicsuggest)
        .copy(bower + 'magicsuggest/magicsuggest-min.css', magicsuggest)
        // Selectize
        .copy(bower + 'selectize/dist/css/selectize.bootstrap3.css', selectize)
        .copy(bower + 'selectize/dist/js/standalone/selectize.min.js', selectize)
        // FontAwesome
        .copy(bower + 'font-awesome/css/font-awesome.min.css', fontawesome)
        .copy(bower + 'font-awesome/fonts', 'public/vendor/fonts')
        // DropZone
        .copy(bower + 'dropzone/dist/min/dropzone.min.css',dropzone)
        .copy(bower + 'dropzone/dist/min/dropzone.min.js',dropzone)
        // RequireJS
        .copy(bower + 'requirejs/require.js', require)
        // RequireJS Text
        .copy(bower + 'text/text.js', require)
        // Css Normalize
        .copy(bower + 'normalize-css/normalize.css', normalize)
        // Auth functions
        .copy(root + 'js/auth.js', js);

    // Admin dashboard js source.
     mix.scripts([
         utils+'utils.js',
         adminModels,
         adminViews,
         adminRouter+'router.js',
         adminSource+'constants.js',
         adminSource+'admin.js'] , js+'admin.js');

    // User app js source.
    mix.scripts([
        utils+'utils.js',
        userModels,
        userViews,
        userRouter+'router.js',
        userSource+'constants.js',
        userSource+'user.js',] , 'public/app.js');

    // Versioning
    mix.version(['assets/css/app.css', 'assets/js/admin.js', 'app.js', 'assets/js/auth.js']);

});
