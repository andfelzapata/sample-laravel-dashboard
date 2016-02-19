
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

        Handlebars.registerHelper(handlebarsLayouts(Handlebars));

        Handlebars.registerPartial('layout', $("#main-layout").html());

        // Compile template
        superTemplate = Handlebars.compile( $("#home-page").html());

        // Render template
        var output = superTemplate({
            title: 'Layout Test',
            items: [
                'apple',
                'orange',
                'banana'
            ]
        });

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