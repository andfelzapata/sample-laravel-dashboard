// App Namespace
var GardenRev = new Marionette.Application();

GardenRev.addInitializer(function() {
    GardenRev.MainLayoutView = new MainLayoutView();
    GardenRev.MainController = new MainController();
    GardenRev.MainRouter = new MainRouter();
    Backbone.history.start();

});

GardenRev.start();