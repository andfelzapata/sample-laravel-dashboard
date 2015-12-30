
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
        CONTAINER_ELEMENT = $("#body-container");

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