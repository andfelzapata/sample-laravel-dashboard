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
