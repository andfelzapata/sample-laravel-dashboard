/**
 * Get partial views from server.
 */
var DashboardPartial = (function(){

    var _getPartialView = function () {

        return $.ajax({
            url: _baseUrl + _url,
            async: true,
        });

    };

    return  {
        get: function (url) {
            _url = url;
            _baseUrl = '/dashboard/';
            return _getPartialView();
        }

    };

}());


/**
 * Display errors.
 */
var serverError = (function (response) {

    var defaultMessage = 'There seems to be a problem with the server,' +
        'please try again or contact support if problem persists.';

    var message = response.responseJSON.error || defaultMessage;

    return swal({title: "Whoops!",
            text: message,
            type: "error",
            confirmButtonColor: "#DA4453",
            confirmButtonText: "Ok"},
        function(){
            window.location.href = '/dashboard';
        });

});
/**
 * Parent View
 *
 * All other views render inside this container.
 */
var ContainerView = Backbone.View.extend({
    ChildView: null,

    render: function() {
        this.$el.html(this.ChildView.$el);
        this.ChildView.delegateEvents();
        return this;
    }
});

/**
 * Return Dashboard View.
 */
var SettingsView = Backbone.View.extend({

    initialize: function(ob) {
        var url = ob.route;
        this.render(url);
    },

    render: function(url) {
        var self = this;

        DashboardPartial.get(url).done(function(partial){
            self.$el.html(partial);

        }).error(function(partial) {
            serverError();
        });

        return self;
    }
});
/* resources/src/routers/app-router.js */

/**
 * Application Main Router
 */
var Router = Backbone.Router.extend({

    container: null,
    settingsView: null,

    initialize: function() {
        this.container = new ContainerView({ el: CONTAINER_ELEMENT });
    },

    routes: {
        "settings": "showSettings",
    },

    /**
     * Default dashboard view.
     */
    showSettings: function () {
        var url = Backbone.history.location.hash.substr(1);
        this.settingsView = new SettingsView({ route: url });

        this.container.ChildView = this.settingsView;
        this.container.render();
    },

});


(function(exports, $){

    //document ready
    $(function(){

        /**
         *
         * Globals

         */

        WINDOW = $(window);
        DOCUMENT = $(document);
        BODY   = $('body');
        CONTAINER_ELEMENT = $("#body-content");

        /**
         * Initializes de app's Routes Controller.
         *
         */
        AppRouter = new Router();

        /**
         * Start Backbone url history.
         *
         */
        Backbone.history.start();

    });

}(this, jQuery));
//# sourceMappingURL=app.js.map
