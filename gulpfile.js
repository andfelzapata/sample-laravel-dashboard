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

/**
 * App Source Files
 */
var appSource = '/src/';
var models      = appSource  + 'models/';
var routers     = appSource  + 'routers/';
var utils       = appSource  + 'utils/';
var views       = appSource  + 'views/';


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

elixir(function(mix) {

    mix.sass(['app.scss','home.css']);

	mix.styles([
		'style.css'
	], css+'dashboard.css');

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
		.copy(bower + 'typeahead.js/dist/typeahead.bundle.js', typeahead);

     mix.scripts([
         utils+'utils.js',
         views+'views.js',
         routers+'router.js',
		 'app.js',
		 'dashboard.js',
         appSource+'app.js',] , js+'app.js');
});