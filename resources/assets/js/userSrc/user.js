Marionette.TemplateCache.prototype.loadTemplate = function ( templateId ) {
    var template = '',
        url = '/templates/' + templateId + '.html';

    // Load the template by fetching the URL content synchronously.
    Backbone.$.ajax( {
        async   : false,
        url     : url,
        success : function ( templateHtml ) {
            template = templateHtml;
        }
    } );

    return template;
};

// Instruct Marionette to use Handlebars.
Marionette.TemplateCache.prototype.compileTemplate = function ( template ) {
    return Handlebars.compile( template );
};

var GardenRevApp = new Marionette.Application();

GardenRevApp.AdminLayoutView = Marionette.LayoutView.extend({
    el: 'body', 

    regions: {
        mainRegion: "#app",
    }
});

GardenRevApp.IndexView = Marionette.ItemView.extend({
    template: Marionette.TemplateCache.get('partials/index')
});

GardenRevApp.UserAdmin = new GardenRevApp.AdminLayoutView();

GardenRevApp.UserAdmin.getRegion('mainRegion').show(new GardenRevApp.IndexView());