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

        DashboardPartial.get(url).done(function(response){
            self.$el.html(response);

        }).error(function(response) {
            ServerError(response);
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
                confirmButtonColor: SUSHI,
                confirmButtonText: OK,
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
                        success: function(model, response) {
                            swal({
                                    title: 'Delete Successful',
                                    text: 'Successfully deleted this user',
                                    type: 'success',
                                    confirmButtonColor: SUSHI,
                                    confirmButtonText: OK
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
                                confirmButtonColor: SUSHI,
                                confirmButtonText: OK
                            });
                        }
                    });
                }
            });
    }
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
                        confirmButtonColor: SUSHI,
                        confirmButtonText: OK,
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
                    confirmButtonColor: SUSHI,
                    confirmButtonText: OK,
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
                    confirmButtonColor: SUSHI,
                    confirmButtonText: OK,
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
                    confirmButtonColor: SUSHI,
                    confirmButtonText: OK,
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

        DashboardPartial.get(url).done(function(response){
            self.$el.html(response);

        }).error(function(response) {
            ServerError(response);
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
                        confirmButtonColor: SUSHI,
                        confirmButtonText: OK,
                        closeOnConfirm: true
                    });

                    model.id = response.settings_id;
                }

                else {
                    swal({
                        title: 'Settings Updated!',
                        text: 'The settings were successfully updated.',
                        type: 'success',
                        confirmButtonColor: SUSHI,
                        confirmButtonText: OK,
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
                        confirmButtonColor: SUSHI,
                        confirmButtonText: OK,
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
                        confirmButtonColor: SUSHI,
                        confirmButtonText: OK
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

        DashboardPartial.get(url).done(function(response){
            self.$el.html(response);

        }).error(function(response) {
            ServerError(response);
        });

        return self;
    },
});
