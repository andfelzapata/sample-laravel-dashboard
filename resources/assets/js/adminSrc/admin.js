
(function(exports, $){

    //document ready
    $(function(){

        /**
         *
         * Globals

         */

        WINDOW = $(window);
        DOCUMENT = $(document);
        BODY   = $(BODY);
        CONTAINER_ELEMENT = $(BODY_CONTAINER);

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
