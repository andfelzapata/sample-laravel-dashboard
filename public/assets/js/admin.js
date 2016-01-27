/**
 * Get partial views from server.
 */
var DashboardPartial = (function(){

    var _getPartialView = function () {

        return $.ajax({
            url: _url,
            async: true,
        });

    };

    return  {
        get: function (url) {
            _url = url;
            return _getPartialView();
        }

    };

}());

/**
 * Make ajax calls to server,
 * specifying type (POST,GET, etc), url, and
 * data submitted.
 */
var ServerCall = (function (){

    var _sendRequest = function(type, url, data) {

        return $.ajax({
            type: type,
            url: url,
            data: data,
            async: true

        });
    };

    return {
        request: function(type, url, data) {
            return _sendRequest(type, url, data);
        }
    };

}());



/**
 * Display errors.
 */
var ServerError = (function (response) {

    var defaultMessage = 'There seems to be a problem with the server,' +
        'please try again or contact support if problem persists.';

    var message = response.responseJSON.error || defaultMessage;

    return swal({title: "Whoops!",
            text: message,
            type: "error",
            confirmButtonColor: "#DA4453",
            confirmButtonText: "Ok"},
        function(){
            window.location.href = '/';
        });

});

/**
 * Filter tables with any text.
 */
var TableFilter = (function () {

    var _caseInsensitiveContains = function () {

        // Case insensitive alternative to jquery contains.
        jQuery.expr[':'].Contains = function(a, i, m) {
            return jQuery(a).text().toUpperCase().indexOf(m[3].toUpperCase()) >= 0;
        };

    };

    var _initFilter = function (inputSelector) {

        $(inputSelector).keyup(function () {
            //split the current value of searchInput
            var data = this.value.split(" ");
            //create a jquery object of the rows
            var rowObject = $("tbody").find("tr");
            if (this.value == "") {
                rowObject.show();
                return;
            }
            //hide all the rows
            rowObject.hide();

            //Recursively filter the jquery object to get results.
            rowObject.filter(function (i, v) {
                var $t = $(this);
                for (var d = 0; d < data.length; ++d) {
                    if ($t.is(":Contains('" + data[d] + "')")) {
                        return true;
                    }
                }
                return false;
            })
                //show the rows that match.
                .show();
        }).focus(function () {
            this.value = "";
            $(this).css({
                "color": "black"
            });
            $(this).unbind('focus');
        }).css({
            "color": "#C0C0C0"
        });

    };

    return {
        init: function (inputSelector) {
            _caseInsensitiveContains();
            _initFilter(inputSelector);
        }
    };

}());


/*
 * This function grabs all input fields from the given form with id.
 */
var input = (function(id) {
    //return $(id).serializeArray();
    return $(id).map(function() {
        return { name : this.name, value: this. value };
    });
});

/*
 * This function serializes input.
 */
var objectSerialize = (function (identifier) {
    var input = this.input(identifier);
    return _(input).reduce(function(acc, field) {
        acc[field.name] = field.value;
        return acc;
    },{});
});

/*
 * This function assigns validation errors returnedwith ajax response to corresponding form field.
 */
var assignErrorToField = (function (error, key) {
    var field = $('[name='+key+']') ;

    $(field).next('.validation-error').html(error);
});

/*
 *Loops through validation errors and calls function that renders them.
 */
var showErrors = (function (response) {

    $('.validation-error').text('');

    var errors = response.responseJSON;

    _.each(errors, function(num, key) {
        assignErrorToField(num, key);
    });

});


var SelectizeCreateRemote = (function (response) {

});

/**
 * Plant Model
 */
var CulinaryPlant = Backbone.Model.extend({
    urlRoot: 'culinary-plants'
});

/**
 * Payment Model
 */
var Payment = Backbone.Model.extend({
    urlRoot: 'payments'
});

/**
 * Plant Model
 */
var Plant = Backbone.Model.extend({
    urlRoot: 'plants'
});

/**
 * Profile Model
 */
var Profile = Backbone.Model.extend({
    urlRoot: 'profiles'
});

/**
 * Settings Model
 */
var Settings = Backbone.Model.extend({
    urlRoot: 'settings'
});

/**
 * User Model
 */
var User = Backbone.Model.extend({
    urlRoot: 'users'
});

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

        this.model.save(data,{
            wait: true,
            data: data,
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

        this.model.save(data,{
            wait: true,
            data: data,
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

/* resources/src/routers/app-router.js */

/**
 * Application Main Router
 */
var Router = Backbone.Router.extend({

    /**
     * Base url for backend service.
     */
    baseUrl: '/admin/dashboard/',
    /**
     * Parent Container
     */
    container: null,
    /**
     * Child views containers
     */
    accountsView: null,
    usersView: null,
    systemNotificationsView: null,
    plansView: null,
    /**
     * Plants
     */
    plantLibraryView: null, // Shows collection of plants
    plantShowView: null, // Shows single plant
    plantAddView: null, // Shows form for creating plant
    plantEditView: null, // Shows form for editing plant
    /**
     * Users
     */
    userEditView: null,
    /**
     * Culinary Plants
     */
    culinaryPlantLibraryView: null,
    /**
     * Procedures
     */
    procedureLibraryView: null,
    /**
     * Pests
     */
    pestLibraryView: null,
    websitePagesView: null,
    categoriesView: null,
    journalView: null,
    glossaryView: null,
    linksView: null,
    userSuggestionsView: null,
    whatsThisView: null,
    generalMessagesView: null,
    paymentConnectionView: null,
    apisConnectionView: null,
    adminProfileView: null,
    adminDashboardSettingsView: null,

    initialize: function() {
        this.bindGlobalEvents(); // All admin dashboard bindings should go here.
        this.container = new ContainerView({ el: CONTAINER_ELEMENT }); // Create view parent container.
    },

    /**
     * Definition of global event bindings.
     */
    bindGlobalEvents: function() {
        $('body').on('click', '.menu-toggle.sidebar-close', this.bindSidebarClose);
        $('body').on('click', '.menu-toggle.sidebar-open', this.bindSidebarOpen);
        $('body').on('click', '.sidebar-nav li', this.bindSidebarItems);
    },

    /**
     * Application routes.
     */
    routes: {
        "accounts": "showAccounts",
        "users": "showUsers",
        "users?page:num": "showUsers",
        "users/create": "createUser",
        "users/:id/edit": "editUser",
        "system-notifications": "showSystemNotifications",
        "plans": "showPlans",
        /**
         * Plants Routes
         */
        "plants": "showPlantLibrary",
        "plants/create": "createPlant",
        "plants/:id/edit": "editPlant",
        /**
         * Culinary Routes
         */
        "culinary-plants": "showCulinaryPlantLibrary",
        "culinary-plants/create": "createCulinaryPlant",
        "culinary-plants/:id/edit": "editCulinaryPlant",
        /**
         * Pest Routes
         */
        "pests": "showPestLibrary",
        /**
         * Procedures Routes
         */
        "procedures": "showProcedureLibrary",
        /**
         * Web Pages Routes
         */
        "pages": "showWebsitePages",
        /**
         * Categories Routes
         */
        "categories": "showCategories",
        /**
         * Journals Routes
         */
        "journals": "showJournal",
        /**
         * Glossary Routes
         */
        "glossary": "showGlossary",
        /**
         * Links Routes
         */
        "links": "showLinks",
        /**
         * User Suggestions Routes
         */
        "user-suggestions": "showUserSuggestions",
        /**
         * What's This Messages Routes
         */
        "whats-this": "showWhatsThis",
        /**
         * General Messages Rotues
         */
        "general-messages": "showGeneralMessages",
        /**
         * Payment Connections Routes
         */
        "payment-connection": "showPaymentConnector",
        /**
         * Apis Connections Routes
         */
        "apis-connection": "showApisConnection",
        /**
         * Admin Profile Routes
         */
        "profile": "showAdminProfile",
        /**
         * Dashboard Settings Routes
         */
        "settings": "showAdminDashboardSettings",
        /**
         * Dashboard Logout
         */
        "logout": "adminLogout"

    },

    /****************************
     * Admin User Accounts
     ****************************/
    showAccounts: function () {
        var url = Backbone.history.location.hash.substr(1); // url part after hash e.g #accounts
        this.accountsView = new AdminAccountsView({ route: this.baseUrl + url });

        this.container.ChildView = this.accountsView;
        this.container.render();
    },

    /****************************
     * Show Applicaiton Users
     ****************************/
    showUsers: function () {
        var url = Backbone.history.location.hash.substr(1);
        var model = new User();

        this.usersView = new UsersView({ model: model, route: this.baseUrl + url });

        this.container.ChildView = this.usersView;
        this.container.render();
    },


    /****************************
     * System Notifications
     ****************************/
    showSystemNotifications: function () {
        var url = Backbone.history.location.hash.substr(1);
        this.systemNotificationsView = new SystemNotificationsView({ route: this.baseUrl + url });

        this.container.ChildView = this.systemNotificationsView;
        this.container.render();
    },

    /****************************
     * User subscription plans
     ****************************/
    showPlans: function () {
        var url = Backbone.history.location.hash.substr(1);
        this.plansView = new PlansView({ route: this.baseUrl + url });

        this.container.ChildView = this.plansView;
        this.container.render();
    },

    /****************************
     * Edit User
     ****************************/
    editUser: function() {
        var url = Backbone.history.location.hash.substr(1);
        var model = new User();
 
        var user = new User();
        var profile = new Profile();
        var settings = new Settings();
        var payment = new Payment();
        
        this.userEditView = new EditUserView({ user: user, profile: profile, settings: settings, payment: payment, route: this.baseUrl + url });


        this.container.ChildView = this.userEditView;
        this.container.render();
    },

    /****************************
     * Create User
     ****************************/
    createUser: function() {
        var url = Backbone.history.location.hash.substr(1);
        var user = new User();
        var profile = new Profile();
        var settings = new Settings();

        this.userCreateView = new CreateUserView({ 
                                                    user: user,
                                                    profile: profile,
                                                    settings: settings,
                                                    route: this.baseUrl + url 
                                                  });

        this.container.ChildView = this.userCreateView;
        this.container.render();
    },

    /****************************
     * Plant Library Views
     ****************************/
    showPlantLibrary: function () {
        var url = Backbone.history.location.hash.substr(1);
        var model = new Plant();
        this.plantLibraryView = new PlantLibraryView({ model: model, route: this.baseUrl + url });

        this.container.ChildView = this.plantLibraryView;
        this.container.render();
    },

    createPlant: function() {
        var url = Backbone.history.location.hash.substr(1);
        var model = new Plant();

        this.plantCreateView = new CreatePlantView({ model:  model, route: this.baseUrl + url });

        this.container.ChildView = this.plantCreateView;
        this.container.render();
    },

    editPlant: function() {
        var url = Backbone.history.location.hash.substr(1);
        var model = new Plant();

        this.plantEditView = new EditPlantView({ model: model, route: this.baseUrl + url });

        this.container.ChildView = this.plantEditView;
        this.container.render();
    },

    /*******************************
     * Culinary Plant Library Views
     *******************************/
    showCulinaryPlantLibrary: function () {
        var url = Backbone.history.location.hash.substr(1);
        this.culinaryPlantLibraryView = new CulinaryPlantLibraryView({ route: this.baseUrl + url });

        this.container.ChildView = this.culinaryPlantLibraryView;
        this.container.render();
    },

    createCulinaryPlant: function() {
        var url = Backbone.history.location.hash.substr(1);
        var model = new CulinaryPlant();

        this.plantCreateView = new CreateCulinaryPlantView({ model:  model, route: this.baseUrl + url });

        this.container.ChildView = this.plantCreateView;
        this.container.render();
    },

    editCulinaryPlant: function() {
        var url = Backbone.history.location.hash.substr(1);
        var model = new Plant();

        this.plantEditView = new EditCulinaryPlantView({ model: model, route: this.baseUrl + url });

        this.container.ChildView = this.plantEditView;
        this.container.render();
    },

    /****************************
     * Pest Library Views
     ****************************/
    showPestLibrary: function () {
        var url = Backbone.history.location.hash.substr(1);
        this.pestLibraryView = new PestLibraryView({ route: this.baseUrl + url });

        this.container.ChildView = this.pestLibraryView;
        this.container.render();
    },

    /****************************
     * Procedure Library Views
     ****************************/
    showProcedureLibrary: function () {
        var url = Backbone.history.location.hash.substr(1);
        this.procedureLibraryView = new ProcedureLibraryView({ route: this.baseUrl + url });

        this.container.ChildView = this.procedureLibraryView;
        this.container.render();
    },

    /****************************
     * Website Pages Views
     ****************************/
    showWebsitePages: function () {
        var url = Backbone.history.location.hash.substr(1);
        this.websitePagesView = new WebsitePagesView({ route: this.baseUrl + url });

        this.container.ChildView = this.websitePagesView;
        this.container.render();
    },

    /****************************
     * Categories Views
     ****************************/
    showCategories: function () {
        var url = Backbone.history.location.hash.substr(1);
        this.categoriesView = new CategoriesView({ route: this.baseUrl + url });

        this.container.ChildView = this.categoriesView;
        this.container.render();
    },

    /****************************
     * Journal Views
     ****************************/
    showJournal: function () {
        var url = Backbone.history.location.hash.substr(1);
        this.journalView = new JournalView({ route: this.baseUrl + url });

        this.container.ChildView = this.journalView;
        this.container.render();
    },

    /****************************
     * Glossary Views
     ****************************/
    showGlossary: function () {
        var url = Backbone.history.location.hash.substr(1); // url part after hash e.g #accounts
        this.glossaryView = new GlossaryView({ route: this.baseUrl + url });

        this.container.ChildView = this.glossaryView;
        this.container.render();
    },

    /****************************
     * Categories Views
     ****************************/
    showLinks: function () {
        var url = Backbone.history.location.hash.substr(1); // url part after hash e.g #accounts
        this.linksView = new LinksView({ route: this.baseUrl + url });

        this.container.ChildView = this.linksView;
        this.container.render();
    },

    /****************************
     * User Suggestions Views
     ****************************/
    showUserSuggestions: function () {
        var url = Backbone.history.location.hash.substr(1); // url part after hash e.g #accounts
        this.userSuggestionsView = new UserSuggestionsView({ route: this.baseUrl + url });

        this.container.ChildView = this.userSuggestionsView;
        this.container.render();
    },

    /****************************
     * What's This Views
     ****************************/
    showWhatsThis: function () {
        var url = Backbone.history.location.hash.substr(1); // url part after hash e.g #accounts
        this.whatsThisView = new WhatsThisView({ route: this.baseUrl + url });

        this.container.ChildView = this.whatsThisView;
        this.container.render();
    },

    /****************************
     * General Messages Out Views
     ****************************/
    showGeneralMessages: function () {
        var url = Backbone.history.location.hash.substr(1); // url part after hash e.g #accounts
        this.generalMessagesView = new GeneralMessagesView({ route: this.baseUrl + url });

        this.container.ChildView = this.generalMessagesView;
        this.container.render();
    },

    /******************************
     * Payment Connection Api Views
     *****************************/
    showPaymentConnector: function () {
        var url = Backbone.history.location.hash.substr(1); // url part after hash e.g #accounts
        this.paymentConnectionView = new PaymentConnectorView({ route: this.baseUrl + url });

        this.container.ChildView = this.paymentConnectionView;
        this.container.render();
    },

    /******************************
     * Outbound Api's Connection  Views
     *****************************/
    showApisConnection: function () {
        var url = Backbone.history.location.hash.substr(1); // url part after hash e.g #accounts
        this.apisConnectionView = new ApisConnectionView({ route: this.baseUrl + url });

        this.container.ChildView = this.apisConnectionView;
        this.container.render();
    },

    /****************************
     * Admin Profile Views
     ****************************/
    showAdminProfile: function () {
        var url = Backbone.history.location.hash.substr(1); // url part after hash e.g #accounts
        this.adminProfileView = new AdminProfileView({ route: this.baseUrl + url });

        this.container.ChildView = this.adminProfileView;
        this.container.render();
    },

    /*********************************
     * Admin Dashboard Settings Views
     ********************************/
    showAdminDashboardSettings: function () {
        var url = Backbone.history.location.hash.substr(1); // url part after hash e.g #accounts
        this.adminDashboardSettingsView = new AdminDashboardSettingsView({ route: this.baseUrl + url });

        this.container.ChildView = this.adminDashboardSettingsView;
        this.container.render();
    },

    adminLogout: function () {

        ServerCall.request('GET', '/admin/dashboard/logout', '').success( function() {

            $(location).attr('href','/admin/login');
            //$(location).prop('pathname', '/admin/dashboard/login');

        })

    },

    /*****************************
     * Definition of global events
     ******************************/

    // Hide left arrow/ Show right arrow
    bindSidebarClose: function(e) {
        e.preventDefault();
        $("#menu-sidebar").hide();
        $(this).hide();
        $(".sidebar-open").show();
    },

    // Hide right arrow/ Show left arrow
    bindSidebarOpen: function (e) {
        e.preventDefault();
        $("#menu-sidebar").show();
        $(this).hide();
        $(".sidebar-close").show();
    },

    // Add active class to selected menu item.
    bindSidebarItems: function(e) {
        $(".sidebar-nav li").removeClass('sidebar-menu-item-active')
        $(this).addClass('sidebar-menu-item-active');
    }

});


(function(exports, $){

    //document ready
    $(function(){

        /**
         *
         * Globals

         */

        WINDOW = $(window);
        DOCUMENT = $(document);
        BODY   = $('body');
        CONTAINER_ELEMENT = $("#body-container");

        /**
         * Initializes de app's Routes Controller.
         *
         */
        AppRouter = new Router();

        /**
         * Start Backbone url history.
         *
         */
        Backbone.history.start();

    });

}(this, jQuery));

//# sourceMappingURL=admin.js.map
