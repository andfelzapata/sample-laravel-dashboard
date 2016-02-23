var MainController = Marionette.Controller.extend({

    showHome: function() {
        var MainView = Marionette.ItemView.extend({
            template: Marionette.TemplateCache.get('pages/home')
        });

        GardenRev.MainLayoutView.getRegion('mainRegion').show(new MainView());
        GardenRev.HomeLayoutView = new HomeLayoutView();
        GardenRev.HomeLayoutView.getRegion('header').show(new Header());
        GardenRev.HomeLayoutView.getRegion('footer').show(new Footer());
    }

});