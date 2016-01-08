/**
 * Get partial views from server.
 */
var DashboardPartial = (function(){

    var _getPartialView = function () {

        return $.ajax({
            url: _url,
            async: true,
        });

    };

    return  {
        get: function (url) {
            _url = url;
            return _getPartialView();
        }

    };

}());

/**
 * Make ajax calls to server,
 * specifying type (POST,GET, etc), url, and
 * data submitted.
 */
var ServerCall = (function (){

    var _sendRequest = function(type, url, data) {

        return $.ajax({
            type: type,
            url: url,
            data: data,
            async: true

        });
    };

    return {
        request: function(type, url, data) {
            console.log(url);
            return _sendRequest(type, url, data);
        }
    };

}());



/**
 * Display errors.
 */
var ServerError = (function (response) {

    var defaultMessage = 'There seems to be a problem with the server,' +
        'please try again or contact support if problem persists.';

    var message = response.responseJSON.error || defaultMessage;

    return swal({title: "Whoops!",
            text: message,
            type: "error",
            confirmButtonColor: "#DA4453",
            confirmButtonText: "Ok"},
        function(){
            window.location.href = 'admin/dashboard';
        });

});

/**
 * Filter tables with any text.
 */
var TableFilter = (function () {

    var _caseInsensitiveContains = function () {

        // Case insensitive alternative to jquery contains.
        jQuery.expr[':'].Contains = function(a, i, m) {
            return jQuery(a).text().toUpperCase().indexOf(m[3].toUpperCase()) >= 0;
        };

    };

    var _initFilter = function (inputSelector) {

        $(inputSelector).keyup(function () {
            //split the current value of searchInput
            var data = this.value.split(" ");
            //create a jquery object of the rows
            var rowObject = $("tbody").find("tr");
            if (this.value == "") {
                rowObject.show();
                return;
            }
            //hide all the rows
            rowObject.hide();

            //Recursively filter the jquery object to get results.
            rowObject.filter(function (i, v) {
                var $t = $(this);
                for (var d = 0; d < data.length; ++d) {
                    if ($t.is(":Contains('" + data[d] + "')")) {
                        return true;
                    }
                }
                return false;
            })
                //show the rows that match.
                .show();
        }).focus(function () {
            this.value = "";
            $(this).css({
                "color": "black"
            });
            $(this).unbind('focus');
        }).css({
            "color": "#C0C0C0"
        });

    };

    return {
        init: function (inputSelector) {
            _caseInsensitiveContains();
            _initFilter(inputSelector);
        }
    };

}());
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
