/**
 * Return user's suggestions messages view.
 */
var UserSuggestionsView = Backbone.View.extend({

    initialize: function(ob) {
        var url = ob.route;
        this.render(url);
    },

    render: function(url) {
        var self = this;

        DashboardPartial.get(url).done(function(response){
            self.$el.html(response);

        }).error(function(response) {
            ServerError();
        });

        return self;
    }
});
