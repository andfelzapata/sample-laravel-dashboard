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