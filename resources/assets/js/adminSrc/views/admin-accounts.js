
/**
 * Return admin accounts view.
 */
var AdminAccountsView = Backbone.View.extend({

    initialize: function(ob) {
        var url = ob.route; // eg. /admin/dashboard/accounts.
        this.render(url);
    },

    render: function(url) {
        var self = this;

        DashboardPartial.get(url).done(function(response){
            self.$el.html(response);

        }).error(function(response) {
            ServerError(response);
        });

        return self;
    }
});
