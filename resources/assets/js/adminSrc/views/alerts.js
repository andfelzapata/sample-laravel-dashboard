/********************************
 * Return alert library view.
 *******************************/
var AlertLibraryView = Backbone.View.extend({

    initialize: function(ob) {
        var url = ob.route;
        this.render(url);
    },

    render: function(url) {
        var self = this;

        DashboardPartial.get(url).done(function(partial){
            self.$el.html(partial);

        }).error(function(partial) {
            ServerError();
        });

        return self;
    },

    events: {
        "click .delete-alert": "confirmDelete"
    },

    confirmDelete: function(e) {
        e.preventDefault();
        var self = this;
        swal({  title: "Are you sure ?",
                text: "Are you sure you want to delete this alert? This action cannot be undone.",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#37BC9B",
                confirmButtonText: "Yes, delete it!",
                closeOnConfirm: false },
            function() {

                self.deleteAlert(e);

            });
    },

    deleteAlert: function(e) {;
        e.preventDefault();
        var id = $(e.currentTarget).siblings("#alertId").data('alert-id');
        var token = $('#token').val()

        this.model.set({id: id, _token: token });

        this.model.destroy({
            wait: true,
            success: function(model, response) {
                swal({
                        title: 'Delete Successful',
                        text: 'Successfully deleted this alert',
                        type: 'success',
                        confirmButtonColor: "#8DC53E",
                        confirmButtonText: "Ok"
                    },

                    function() {
                        Backbone.history.loadUrl(Backbone.history.fragment);
                    });
            },

            error: function() {
                swal({
                    title: 'Delete Unsuccessful',
                    text: 'Something went wrong deleting this alert',
                    type: 'error',
                    confirmButtonColor: "#8DC53E",
                    confirmButtonText: "Ok"
                });
            }
        });
    }
});

/************************************
 * Return create alert view.
 ***********************************/
var CreateAlertView = Backbone.View.extend({

    initialize: function(ob) {
        var url = ob.route;
        this.render(url);
        this.delegateEvents();
    },

    events: {
        "click #create-alert": "createAlert",
    },

    render: function(url) {
        var self = this;

        DashboardPartial.get(url).done(function(partial){
            self.$el.html(partial);

        }).error(function(partial) {
            ServerError();
        });

        return self;
    },

    createAlert: function(e) {
        e.preventDefault();

        var form = document.getElementById('create-alert-form');
        var data = new FormData(form);

        this.model.save(data, {
            wait: true,
            data: data,
            processData: false,
            contentType: false,
            emulateJSON:true,
            success:function(model, response) {
                swal({
                        title: 'Alert Created!',
                        text: 'The alert was successfully created.',
                        type: 'success',
                        confirmButtonColor: "#8DC53E",
                        confirmButtonText: "Ok"
                    },
                    function() {
                        AppRouter.navigate('alerts', {trigger:true} );
                    });
            },
            error: function(model, errors) {

                if(errors.status == 422)
                {
                    showErrors(errors)
                }

                else ServerError(errors);
            }
        });
    }

});

/***********************************
 * Return edit alert view.
 ***********************************/
var EditAlertView = Backbone.View.extend({

    initialize: function(ob) {
        var url = ob.route;
        this.render(url);
    },

    events: {
        "click #update-alert": "updateAlert"
    },

    render: function(url) {
        var self = this;

        DashboardPartial.get(url).done(function(partial){

            self.$el.html(partial);

        }).error(function(partial) {

            ServerError();

        });

        return self;
    },

    updateAlert: function(e) {
        e.preventDefault();

        var form = document.getElementById('update-alert-form');
        var data = new FormData(form);

        var id = $("[name='id']").val();

        this.model.save(data,{
            wait: true,
            data: data,
            method: 'POST',
            url: 'alerts/'+id+'/update/',
            processData: false,
            contentType: false,
            emulateJSON:true,
            success:function(model, response) {
                swal({
                        title: 'Alert Updated!',
                        text: 'The alert was successfully updated.',
                        type: 'success',
                        confirmButtonColor: "#8DC53E",
                        confirmButtonText: "Ok"
                    },
                    function() {
                        AppRouter.navigate('alerts', {trigger:true} );
                    });
            },
            error: function(model, errors) {

                if(errors.status == 422)
                {
                    showErrors(errors)
                }

                else ServerError(errors);
            }
        });
    },
});