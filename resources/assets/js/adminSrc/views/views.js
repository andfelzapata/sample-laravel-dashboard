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
 * Return create plant view.
 */
var CreatePlantView = Backbone.View.extend({

    max_images_fields: 5, //maximum input boxes allowed

    initial_text_box_count: 1,

    initialize: function(ob) {
        var url = ob.route;
        this.render(url);
        this.delegateEvents();
    },

    events: {
        "click #create-plant": "createPlant",
        "click #add-new-image-fields": "addNewImageFields",
        "click .remove-field": "removeImageField"
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

    addNewImageFields: function(e) {
        e.preventDefault();
        var removeButton = '<a href="#" class="remove-field btn btn-danger"><i class="fa fa-minus"></i></a>';
        if(this.initial_text_box_count < this.max_images_fields) { //max input box allowed
            this.initial_text_box_count ++; //text box increment
            $('.other-images-input-group').last().clone(true).insertBefore('#multi-input-placeholder').find('.remove-field-wrapper').html(removeButton);
        }

    },

    removeImageField: function (e)
    {
        e.preventDefault();
        $(e.target ).parent().parent().remove();
        this.initial_text_box_count --;

    },

    createPlant: function(e) {
        e.preventDefault();

        var form = document.getElementById('create-plant-form');
        var data = new FormData(form);

        data.append('searchable_names',searchableNames.getValue());
        data.append('plant_tolerations', tolerations.getValue());
        data.append('positive_traits', positiveTraits.getValue());
        data.append('negative_traits', negativeTraits.getValue());
        data.append('soils', soils.getValue());

        this.model.save(data, {
            wait: true,
            data: data,
            processData: false,
            contentType: false,
            emulateJSON:true,
            success:function(model, response) {
                swal({
                        title: 'Plant Created!',
                        text: 'The plant was successfully created.',
                        type: 'success',
                        confirmButtonColor: "#8DC53E",
                        confirmButtonText: "Ok"
                    },
                    function() {
                        AppRouter.navigate('plants', {trigger:true} );
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

    events: {
        "click #update-plant": "updatePlant"
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

    updatePlant: function(e) {
        e.preventDefault();

        var form = document.getElementById('update-plant-form');
        var data = new FormData(form);

        data.append('searchable_names',searchableNames.getValue());
        data.append('plant_tolerations', tolerations.getValue());
        data.append('positive_traits', positiveTraits.getValue());
        data.append('negative_traits', negativeTraits.getValue());
        data.append('soils', soils.getValue());

        var id = $("[name='id']").val();

        this.model.save(data,{
            wait: true,
            data: data,
            method: 'POST',
            url: 'plants/'+id+'/update/',
            processData: false,
            contentType: false,
            emulateJSON:true,
            success:function(model, response) {
                swal({
                        title: 'Plant Updated!',
                        text: 'The plant was successfully updated.',
                        type: 'success',
                        confirmButtonColor: "#8DC53E",
                        confirmButtonText: "Ok"
                    },
                    function() {
                        AppRouter.navigate('plants', {trigger:true} );
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

/*
 * Return edit user view.
 */
var EditUserView = Backbone.View.extend({
    events: {
        'click #updateAccount':'updateAccount',
        'click #updateProfile':'updateProfile',
        'click #updateSettings':'updateSettings',
        'click input[name="submit"]':'updatePayment',
    },

    initialize: function(ob) {
        var url = ob.route;
        this.render(url);
        this.user = ob.user;
        this.profile = ob.profile;
        this.settings = ob.settings;
        this.payment = ob.payment;
    },

    updatePayment: function(e) {
        e.preventDefault();
        var paymentData = objectSerialize(input('.payment-form-submitted .payment-field'));
        var userId = $('#user-id').val();
        var _token = $('input[name="_token"]').val();

        var cardNumber = paymentData.card_number;
        var last4 = cardNumber.substring(cardNumber.length-4);
        
        paymentData.last4 = last4;
        paymentData.user_id = userId;
        paymentData._token = _token;

        delete paymentData.card_number;

        this.payment.save(paymentData, {
             wait: true,
             success: function(model, response) {
                swal({
                        title: 'Payment Updated!',
                        text: 'The payment method was successfully updated.',
                        type: 'success',
                        confirmButtonColor: "#8DC53E",
                        confirmButtonText: "Ok",
                        closeOnConfirm: true
                     },

                    function() {
                        $('button:disabled').prop('disabled',false);
                    });
             },
             error: function(model,errors) {
                ServerError(errors);
                $('button:disabled').prop('disabled',false);
             }
        });

    },

    updateSettings: function(e) {
        e.preventDefault();

        var userId = $('#user-id').val();
        var settingsData = objectSerialize(input('.setting-field'));
        settingsData.user_id = userId;
   
        this.settings.save(settingsData,{
            wait: true,
            success: function(model, response) {
                swal({
                        title: 'Settings Updated!',
                        text: 'The settings were successfully updated.',
                        type: 'success',
                        confirmButtonColor: "#8DC53E",
                        confirmButtonText: "Ok",
                        closeOnConfirm: true
                     })
            },

            error: function(model, response) {
                showErrors(response);
            }
        });
    },

    updateProfile: function(e) {
        e.preventDefault();
 
        var userId = $('#user-id').val();
        var profileData = objectSerialize(input('.profile-field'));
        profileData.user_id = userId;

        this.profile.save(profileData,{
            wait: true,
            success: function(model, response) {
                swal({
                        title: 'Profile Updated!',
                        text: 'The profile was successfully updated.',
                        type: 'success',
                        confirmButtonColor: "#8DC53E",
                        confirmButtonText: "Ok",
                        closeOnConfirm: true
                     })
            },

            error: function(model, response) {
                showErrors(response);
            }
        });
    }, 

    updateAccount: function(e) {
        e.preventDefault();
        var data = objectSerialize(input('.user-field'));

        this.user.save(data,{
            wait: true,
            success: function(model, response) {
                swal({
                        title: 'User Updated!',
                        text: 'The user was successfully updated.',
                        type: 'success',
                        confirmButtonColor: "#8DC53E",
                        confirmButtonText: "Ok",
                        closeOnConfirm: true
                     })
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
        'click #createSettings':'createSettings'
    },

    initialize: function(ob) {
        var url = ob.route;
        this.user = ob.user;
        this.profile = ob.profile;
        this.settings = ob.settings;
        this.render(url);
    },

    mustCreateAccount: function(e) {
        e.preventDefault();
        swal('Oops...','Must create account first','error')
    },

    createSettings: function(e) {
        e.preventDefault();
 
        if( ! this.user.id ) 
        {
            this.mustCreateAccount(e);
            return;
        }

        var data = objectSerialize(input('.setting-field'));
        data.user_id = this.user.id;

        if( this.settings.id ) {
            data.id = this.settings.id;
        }
  
        this.settings.save(data,{
            wait: true,
            success: function(model, response) {
                
                if( ! model.id ) {
                    swal({
                            title: 'Settings Creared!',
                            text: 'The settings were successfully created.',
                            type: 'success',
                            confirmButtonColor: "#8DC53E",
                            confirmButtonText: "Ok",
                            closeOnConfirm: true
                     });

                    model.id = response.settings_id;
                }

                else {
                    swal({
                            title: 'Settings Updated!',
                            text: 'The settings were successfully updated.',
                            type: 'success',
                            confirmButtonColor: "#8DC53E",
                            confirmButtonText: "Ok",
                            closeOnConfirm: true
                     });
                }
            },

            error: function(model, response) {
                showErrors(response);
            }
        });
    },

    createProfile: function(e) {
        e.preventDefault();

        if( ! this.user.id ) {
            this.mustCreateAccount(e);
            return;
        }

        var data = objectSerialize(input('.profile-field'));
        data.user_id = this.user.id;
        
        if( this.profile.id )
        {
            data.id = this.profile.id;    
        }

        this.profile.save(data, {
            wait: true,
            success: function(model, response) {

                if( ! model.id ) {
                    swal({
                        title: 'Profile Created!',
                        text: 'The profile was successfully created.',
                        type: 'success',
                        confirmButtonColor: '#8DC53E',
                        confirmButtonText: "Ok",
                        closeOnConfirm: true,
                        closeOnCancel: true
                    });

                    model.id = response.profile_id;
                }

                else {
                    swal({
                        title: 'Profile Updated!',
                        text: 'The profile was successfully updated.',
                        type: 'success',
                        confirmButtonColor: "#8DC53E",
                        confirmButtonText: "Ok",
                        closeOnConfirm: true
                     });
                }
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
                        elements = $('.disabled')
                        elements.removeClass('disabled')
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

/********************************
 * Return culinary plants library.
 ********************************/
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

/************************************
 * Return create culinary plant view.
 ***********************************/
var CreateCulinaryPlantView = Backbone.View.extend({

    max_images_fields: 5, //maximum input boxes allowed

    initial_text_box_count: 1,

    initialize: function(ob) {
        var url = ob.route;
        this.render(url);
        this.delegateEvents();
    },

    events: {
        "click #create-plant": "createPlant",
        "click #add-new-image-fields": "addNewImageFields",
        "click .remove-field": "removeImageField"
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

    addNewImageFields: function(e) {
        e.preventDefault();
        var removeButton = '<a href="#" class="remove-field btn btn-danger"><i class="fa fa-minus"></i></a>';
        if(this.initial_text_box_count < this.max_images_fields) { //max input box allowed
            this.initial_text_box_count ++; //text box increment
            $('.other-images-input-group').last().clone(true).insertBefore('#multi-input-placeholder').find('.remove-field-wrapper').html(removeButton);
        }

    },

    removeImageField: function (e)
    {
        e.preventDefault();
        $(e.target ).parent().parent().remove();
        this.initial_text_box_count --;

    },

    createPlant: function(e) {
        e.preventDefault();

        var form = document.getElementById('create-culinary-plant-form');
        var data = new FormData(form);

        data.append('searchable_names',searchableNames.getValue());
        data.append('plant_tolerations', tolerations.getValue());
        data.append('positive_traits', positiveTraits.getValue());
        data.append('negative_traits', negativeTraits.getValue());
        data.append('soils', soils.getValue());

        this.model.save(data, {
            wait: true,
            data: data,
            processData: false,
            contentType: false,
            emulateJSON:true,
            success:function(model, response) {
                swal({
                        title: 'Culinary Plant Created!',
                        text: 'The culinary plant was successfully created.',
                        type: 'success',
                        confirmButtonColor: "#8DC53E",
                        confirmButtonText: "Ok"
                    },
                    function() {
                        AppRouter.navigate('culinary-plants', {trigger:true} );
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
 * Return edit  culinary plant view.
 ***********************************/
var EditCulinaryPlantView = Backbone.View.extend({

    initialize: function(ob) {
        var url = ob.route;
        this.render(url);
    },

    events: {
        "click #update-plant": "updatePlant"
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

    updatePlant: function(e) {
        e.preventDefault();

        var form = document.getElementById('update-culinary-plant-form');
        var data = new FormData(form);

        data.append('searchable_names',searchableNames.getValue());
        data.append('plant_tolerations', tolerations.getValue());
        data.append('positive_traits', positiveTraits.getValue());
        data.append('negative_traits', negativeTraits.getValue());
        data.append('soils', soils.getValue());

        var id = $("[name='id']").val();

        this.model.save(data,{
            wait: true,
            data: data,
            method: 'POST',
            url: 'culinary-plants/'+id+'/update/',
            processData: false,
            contentType: false,
            emulateJSON:true,
            success:function(model, response) {
                swal({
                        title: 'Culinary Plant Updated!',
                        text: 'The culinary plant was successfully updated.',
                        type: 'success',
                        confirmButtonColor: "#8DC53E",
                        confirmButtonText: "Ok"
                    },
                    function() {
                        AppRouter.navigate('culinary-plants', {trigger:true} );
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

/***************************
 * Return pest library view.
 ***************************/
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
    },

    events: {
        "click .delete-pest": "confirmDelete"
    },

    confirmDelete: function(e) {
        e.preventDefault();
        var self = this;
        swal({  title: "Are you sure ?",
                text: "Are you sure you want to delete this pest? This action cannot be undone.",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#37BC9B",
                confirmButtonText: "Yes, delete it!",
                closeOnConfirm: false },
            function() {

                self.deletePest(e);

            });
    },

    deletePest: function(e) {;
        e.preventDefault();
        var id = $(e.currentTarget).siblings("#pestId").data('pest-id');
        var token = $('#token').val()

        this.model.set({id: id, _token: token });

        this.model.destroy({
            wait: true,
            success: function(model, response) {
                swal({
                        title: 'Delete Successful',
                        text: 'Successfully deleted this pest',
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
                    text: 'Something went wrong deleting this pest',
                    type: 'error',
                    confirmButtonColor: "#8DC53E",
                    confirmButtonText: "Ok"
                });
            }
        });
    }
});

/************************************
 * Return create pest view.
 ***********************************/
var CreatePestView = Backbone.View.extend({

    max_images_fields: 5, //maximum input boxes allowed

    initial_text_box_count: 1,

    initialize: function(ob) {
        var url = ob.route;
        this.render(url);
        this.delegateEvents();
    },

    events: {
        "click #create-pest": "createPest",
        "click #add-new-image-fields": "addNewImageFields",
        "click .remove-field": "removeImageField"
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

    addNewImageFields: function(e) {
        e.preventDefault();
        var removeButton = '<a href="#" class="remove-field btn btn-danger"><i class="fa fa-minus"></i></a>';
        if(this.initial_text_box_count < this.max_images_fields) { //max input box allowed
            this.initial_text_box_count ++; //text box increment
            $('.other-images-input-group').last().clone(true).insertBefore('#multi-input-placeholder').find('.remove-field-wrapper').html(removeButton);
        }

    },

    removeImageField: function (e)
    {
        e.preventDefault();
        $(e.target ).parent().parent().remove();
        this.initial_text_box_count --;

    },

    createPest: function(e) {
        e.preventDefault();

        var form = document.getElementById('create-pest-form');
        var data = new FormData(form);

        data.append('searchable_names',searchableNames.getValue());

        this.model.save(data, {
            wait: true,
            data: data,
            processData: false,
            contentType: false,
            emulateJSON:true,
            success:function(model, response) {
                swal({
                        title: 'Pest Created!',
                        text: 'The pest was successfully created.',
                        type: 'success',
                        confirmButtonColor: "#8DC53E",
                        confirmButtonText: "Ok"
                    },
                    function() {
                        AppRouter.navigate('pests', {trigger:true} );
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
 * Return edit pest view.
 ***********************************/
var EditPestView = Backbone.View.extend({

    initialize: function(ob) {
        var url = ob.route;
        this.render(url);
    },

    events: {
        "click #update-pest": "updatePest"
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

    updatePest: function(e) {
        e.preventDefault();

        var form = document.getElementById('update-pest-form');
        var data = new FormData(form);

        data.append('searchable_names',searchableNames.getValue());

        var id = $("[name='id']").val();

        this.model.save(data,{
            wait: true,
            data: data,
            method: 'POST',
            url: 'pests/'+id+'/update/',
            processData: false,
            contentType: false,
            emulateJSON:true,
            success:function(model, response) {
                swal({
                        title: 'Pest Updated!',
                        text: 'The pest was successfully updated.',
                        type: 'success',
                        confirmButtonColor: "#8DC53E",
                        confirmButtonText: "Ok"
                    },
                    function() {
                        AppRouter.navigate('pests', {trigger:true} );
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

/********************************
 * Return procedure library view.
 *******************************/
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
    },

    events: {
        "click .delete-procedure": "confirmDelete"
    },

    confirmDelete: function(e) {
        e.preventDefault();
        var self = this;
        swal({  title: "Are you sure ?",
                text: "Are you sure you want to delete this procedure? This action cannot be undone.",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#37BC9B",
                confirmButtonText: "Yes, delete it!",
                closeOnConfirm: false },
            function() {

                self.deleteProcedure(e);

            });
    },

    deleteProcedure: function(e) {;
        e.preventDefault();
        var id = $(e.currentTarget).siblings("#procedureId").data('procedure-id');
        var token = $('#token').val()

        this.model.set({id: id, _token: token });

        this.model.destroy({
            wait: true,
            success: function(model, response) {
                swal({
                        title: 'Delete Successful',
                        text: 'Successfully deleted this procedure',
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
                    text: 'Something went wrong deleting this procedure',
                    type: 'error',
                    confirmButtonColor: "#8DC53E",
                    confirmButtonText: "Ok"
                });
            }
        });
    }
});

/************************************
 * Return create procedure view.
 ***********************************/
var CreateProcedureView = Backbone.View.extend({

    max_images_fields: 5, //maximum input boxes allowed

    initial_text_box_count: 1,

    initialize: function(ob) {
        var url = ob.route;
        this.render(url);
        this.delegateEvents();
    },

    events: {
        "click #create-procedure": "createProcedure",
        "click #add-new-image-fields": "addNewImageFields",
        "click .remove-field": "removeImageField"
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

    addNewImageFields: function(e) {
        e.preventDefault();
        var removeButton = '<a href="#" class="remove-field btn btn-danger"><i class="fa fa-minus"></i></a>';
        if(this.initial_text_box_count < this.max_images_fields) { //max input box allowed
            this.initial_text_box_count ++; //text box increment
            $('.other-images-input-group').last().clone(true).insertBefore('#multi-input-placeholder').find('.remove-field-wrapper').html(removeButton);
        }

    },

    removeImageField: function (e)
    {
        e.preventDefault();
        $(e.target ).parent().parent().remove();
        this.initial_text_box_count --;

    },

    createProcedure: function(e) {
        e.preventDefault();

        var form = document.getElementById('create-procedure-form');
        var data = new FormData(form);

        data.append('searchable_names', searchableNames.getValue());

        this.model.save(data, {
            wait: true,
            data: data,
            processData: false,
            contentType: false,
            emulateJSON:true,
            success:function(model, response) {
                swal({
                        title: 'Procedure Created!',
                        text: 'The procedure was successfully created.',
                        type: 'success',
                        confirmButtonColor: "#8DC53E",
                        confirmButtonText: "Ok"
                    },
                    function() {
                        AppRouter.navigate('procedures', {trigger:true} );
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
 * Return edit procedure view.
 ***********************************/
var EditProcedureView = Backbone.View.extend({

    initialize: function(ob) {
        var url = ob.route;
        this.render(url);
    },

    events: {
        "click #update-procedure": "updateProcedure"
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

    updateProcedure: function(e) {
        e.preventDefault();

        var form = document.getElementById('update-procedure-form');
        var data = new FormData(form);

        data.append('searchable_names',searchableNames.getValue());

        var id = $("[name='id']").val();

        this.model.save(data,{
            wait: true,
            data: data,
            method: 'POST',
            url: 'procedures/'+id+'/update/',
            processData: false,
            contentType: false,
            emulateJSON:true,
            success:function(model, response) {
                swal({
                        title: 'Procedure Updated!',
                        text: 'The procedure was successfully updated.',
                        type: 'success',
                        confirmButtonColor: "#8DC53E",
                        confirmButtonText: "Ok"
                    },
                    function() {
                        AppRouter.navigate('procedures', {trigger:true} );
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

/****************************
 * Return website pages view.
 ****************************/
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
