
(function(exports, $){

    App = {};

    Handlebars.registerHelper(handlebarsLayouts(Handlebars));

    require(
        [   'vendor/require/text!/templates/partials/header.html',
            'vendor/require/text!/templates/pages/home.html',
            'vendor/require/text!/templates/partials/footer.html'],

        function (headerTemplate, homeTemplate, footerTemplate) {
            App.headerTemplate = headerTemplate;
            App.homTemplate = homeTemplate;
            App.footerTemplate = footerTemplate;

    });

    /**
     * Initializes de app's Routes Controller.
     *
     */
    App.GardenRevolutionRouter = new AppRouter();

    /**
     * Start Backbone url history.
     *
     */
    Backbone.history.start();

}(this, jQuery));