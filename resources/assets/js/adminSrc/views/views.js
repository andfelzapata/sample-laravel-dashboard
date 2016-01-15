/**
 * Parent View
 *
 * All other views render inside this container.
 */
var ContainerView = Backbone.View.extend({

    // Container for dashboard partials.
    ChildView: null,

    render: function() {
        if(this.ChildView) {
            this.$el.html(this.ChildView.$el);
            this.ChildView.delegateEvents();
            return this;
        }
    }
});

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

        DashboardPartial.get(url).done(function(partial){
            self.$el.html(partial);

        }).error(function(partial) {
            ServerError();
        });

        return self;
    }
});

/**
 * Return application's users view.
 */
var UsersView = Backbone.View.extend({
    events: {
        'click .delete-user': function(e) { this.deleteUser(e,this.model); }
    },

    initialize: function(ob) {
        var url = ob.route;
        this.model = ob.model;
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
    
    deleteUser:  function (e,model) {
        e.preventDefault();
        
        var id = $(e.currentTarget).data('user-id').toString();
        
        model.set('id',id);
        
        swal({
            title: 'Are you sure?',
            text: 'You are about to delete this user!',
            type: 'warning',
            confirmButtonColor: "#8DC53E",
            confirmButtonText: "Ok",
            showCancelButton: true,
            closeOnConfirm: false,
            closeOnCancel: true
        },
        
        function(isConfirm)
        {
            if( isConfirm )
            {
                model.destroy({
                  wait: true,
                  headers: {
                      'X-CSRF-TOKEN': $('#_token').val()
                 },
                  success: function(model, response) {
                        swal({
                            title: 'Delete Successful',
                            text: 'Successfully deleted this user',
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
                            text: 'Something went wrong deleting this user',
                            type: 'error',
                            confirmButtonColor: "#8DC53E",
                            confirmButtonText: "Ok"
                        });
                    }
                });
            }
        });
    }
});

/**
 * Return system notifications view.
 */
var SystemNotificationsView = Backbone.View.extend({

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
    }
});

/**
 * Return users subscription plans view.
 */
var PlansView = Backbone.View.extend({

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
    }
});

/**
 * Return plant library view.
 */
var PlantLibraryView = Backbone.View.extend({

    events: {
        'click .delete-plant': "confirmDelete"
    },


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

    confirmDelete: function(e) {
        e.preventDefault();
        var self = this;
        swal({  title: "Are you sure ?",
                text: "Are you sure you want to delete this plant? This action cannot be undone.",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#37BC9B",
                confirmButtonText: "Yes, delete it!",
                closeOnConfirm: false },
            function() {

                self.deletePlant(e);

            });
    },

    deletePlant: function(e) {;
        e.preventDefault();
        var id = $(e.currentTarget).siblings("#plantId").data('plant-id');
        var token = $('#token').val()

        this.model.set({id: id, _token: token });

        console.log(this.model.get("_token"));

        this.model.destroy({
            wait: true,
            success: function(model, response) {
                swal({
                        title: 'Delete Successful',
                        text: 'Successfully deleted this plant',
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
                    text: 'Something went wrong deleting this plant',
                    type: 'error',
                    confirmButtonColor: "#8DC53E",
                    confirmButtonText: "Ok"
                });
            }
        });
    }

});

/**
 * Return show single plant view.
 */
var ShowPlantView = Backbone.View.extend({

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
    }
});

/**
 * Return create plant view.
 */
var CreatePlantView = Backbone.View.extend({

    events: {
        "click #createPlant": "createPlant"
    },

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

    createPlant: function(e) {
        e.preventDefault();
        var data = objectSerialize(input('#form'));
        data.searchable_names = searchableNames.getValue();
        data.tolerations = tolerations.getValue();
        data.positive_traits = positiveTratis.getValue();
        data.negative_tratis = negativeTraits.getValue();
        data.soils = soils.getValue();

        this.model.save(data, {
           wait: true,
            success:function(model, response) {
                swal({
                        title: 'Plant Created!',
                        text: 'The plant was successfully created.',
                        type: 'success',
                        confirmButtonColor: "#8DC53E",
                        confirmButtonText: "Ok"
                    },
                    function() {
                        console.log(response);
                        AppRouter.navigate('plants',{trigger:true});
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

/**
 * Return edit plant view.
 */
var EditPlantView = Backbone.View.extend({

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
    }
});

/*
 * Return edit user view.
 */
var EditUserView = Backbone.View.extend({
    events: {
        'click #update':'update'
    },

    initialize: function(ob) {
        var url = ob.route;
        this.render(url);
        this.model = ob.model;
    },

    update: function(e) {
        e.preventDefault();
        var data = objectSerialize(input('#form'));

        this.model.save(data,{
            wait: true,
            type: 'PUT',
            success: function(model, response) {
                swal({
                        title: 'User Updated!',
                        text: 'The user was successfully updated.',
                        type: 'success',
                        confirmButtonColor: "#8DC53E",
                        confirmButtonText: "Ok"
                     },

                     function() {
                        AppRouter.navigate('users',{trigger:true});
                });
            },

            error: function(model, response) {
                showErrors(response);
            }
        });
    },

    render: function(url) {
        var self = this;

        DashboardPartial.get(url).done(function(partial){
            self.$el.html(partial);

        }).error(function(partial) {
            ServerError();
        });

        return self;
    }
});

/*
 * Return create user view.
 */
var CreateUserView = Backbone.View.extend({
    events: {
        'click #createAccount':'createAccount',
        'click #createProfile':'createProfile',
    },

    initialize: function(ob) {
        var url = ob.route;
        this.user = ob.user;
        this.profile = ob.profile;
        this.render(url);
    },

    createProfile: function(e) {
        e.preventDefault();
        var data = objectSerialize(input('.profile-field'));
        data.user_id = this.user.id;

        this.profile.save(data, {
            wait: true,
            type: 'POST',
            success: function(model, response) {
                model.id = response.profile_id;

                swal({
                    title: 'Profile Created!',
                    text: 'The profile was successfully created.',
                    type: 'success',
                    confirmButtonColor: '#8DC53E',
                    confirmButtonText: "Ok",
                    closeOnConfirm: true,
                    closeOnCancel: true
                });
            },
            error: function(model, response) {
                showErrors(response);
            }
        });
    },

    createAccount: function(e) {
        e.preventDefault();
        var data = objectSerialize(input('.user-field'));

        this.user.save(data,{
            wait: true,
            type: 'POST',
            success: function(model, response) {
                
                model.id = response.user_id;

                swal({
                        title: 'User Created!',
                        text: 'The user was successfully created.',
                        type: 'success',
                        confirmButtonColor: "#8DC53E",
                        confirmButtonText: "Ok"
                     },

                     function() {
                        disabled = 'disabled'
                        $('#first_name').removeAttr(disabled)
                        $('#last_name').removeAttr(disabled)
                        $('#street_address').removeAttr(disabled)
                        $('#apt_suite').removeAttr(disabled)
                        $('#city').removeAttr(disabled)
                        $('#state').removeAttr(disabled)
                        $('#zip').removeAttr(disabled)
                });
            },

            error: function(model, response) {
                showErrors(response);
            }
        });
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
});

/**
 * Return culinary plants library.
 */
var CulinaryPlantLibraryView = Backbone.View.extend({

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
    }
});

/**
 * Return pest library view.
 */
var PestLibraryView = Backbone.View.extend({

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
    }
});

/**
 * Return procedure library view.
 */
var ProcedureLibraryView = Backbone.View.extend({

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
    }
});

/**
 * Return website pages view.
 */
var WebsitePagesView = Backbone.View.extend({

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
    }
});

/**
 * Return categories view.
 */
var CategoriesView = Backbone.View.extend({

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
    }
});

/**
 * Return journal entries view.
 */
var JournalView = Backbone.View.extend({

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
    }
});

/**
 * Return glossary words view.
 */
var GlossaryView = Backbone.View.extend({

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
    }
});

/**
 * Return links
 */
var LinksView = Backbone.View.extend({

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
    }
});

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

        DashboardPartial.get(url).done(function(partial){
            self.$el.html(partial);

        }).error(function(partial) {
            ServerError();
        });

        return self;
    }
});

/**
 * Return what's this messages view.
 */
var WhatsThisView = Backbone.View.extend({

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
    }
});

/**
 * Return general messages out.
 */
var GeneralMessagesView = Backbone.View.extend({

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
    }
});

/**
 * Return payment api settings view.
 */
var PaymentConnectorView = Backbone.View.extend({

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
    }
});

/**
 * Return outbound api's connections settings view.
 */
var ApisConnectionView = Backbone.View.extend({

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
    }
});

/**
 * Return admin dashboard profile view.
 */
var AdminProfileView = Backbone.View.extend({

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
    }
});

/**
 * Return admin dashboard settings view.
 */
var AdminDashboardSettingsView = Backbone.View.extend({

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
    }
});
