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

  render: function(url) {
    var self = this;

    DashboardPartial.get(url).done(function(response){
      self.$el.html(response);

      Dropzone.autoDiscover = false;
      self.dropzone = new Dropzone("div#file-upload",{
        paramName: "image",
        url: "profiles",
        maxFilesize: 2,
        addRemoveLinks: true,
        maxFiles: 1,
        acceptedFiles: "image/*",
        autoProcessQueue: false,
        dictDefaultMessage: "Drag and drop your image here",
        headers: {
          'Authorization':'Bearer '+localStorage.getItem('token')
        }
      });

      self.dropzone.on('processing',function(file) {
          this.options.url = "/admin/dashboard/profiles/"+$("input[name='id']").val();
      });

      self.dropzone.on('sending',function(file,xhr,formData) {
        var data = input('.profile-field');

        formData.append('_method','patch');

        for( i = 0; i < data.length; i++ )
        {
          formData.append(data[i].name,data[i].value);
        }
      });

      self.dropzone.on('error',function(file,errors,xhr) {
        this.removeAllFiles(true);

        if( xhr.status === 422 ) {
          showErrors(xhr);
        }

        else {
          ServerError(xhr);
        }
      });

      self.dropzone.on('success', function(file, response, xhr) {
        swal({
          title: 'Profile Updated!',
          text: 'The profile was successfully updated.',
          type: 'success',
          confirmButtonColor: SUSHI,
          confirmButtonText: OK
        });
      });

    }).error(function(response) {
      ServerError(response);
    });

    return self;
  },

  updatePayment: function(e) {
    e.preventDefault();
    var paymentData = objectSerialize(input('.payment-form-submitted .payment-field'));

    var cardNumber = paymentData.card_number;
    var last4 = cardNumber.substring(cardNumber.length-4);

    paymentData.last4 = last4;

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

    var settingsData = objectSerialize(input('.setting-field'));

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

    if( this.dropzone.getQueuedFiles().length > 0 )
    {
      this.dropzone.processQueue();
    }

    else
    {

      var profileData = objectSerialize(input('.profile-field'));

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
    }
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

  render: function(url) {
    var self = this;

    DashboardPartial.get(url).done(function(response){
      self.$el.html(response);

      Dropzone.autoDiscover = false;
      self.dropzone = new Dropzone("div#file-upload",{
        paramName: "image",
        url: "profiles",
        maxFilesize: 2,
        addRemoveLinks: true,
        maxFiles: 1,
        acceptedFiles: "image/*",
        autoProcessQueue: false,
        dictDefaultMessage: "Drag and drop your image here",
        headers: {
          'Authorization':'Bearer '+localStorage.getItem('token')
        }
      });

      self.dropzone.on('processing',function(file) {
        if( self.profile.get('id') )
        {
          this.options.url = "/admin/dashboard/profiles/"+self.profile.get('id');
        }
      });

      self.dropzone.on('sending',function(file,xhr,formData) {
        if( ! self.user.get('id') ) {
          this.mustCreateAccount(e);
          return;
        }

        var data = input('.profile-field');
        data.push({ name: 'user_id', value: self.user.get('id') });

        if( self.profile.get('id') )
        {
          data.push({ name: 'id', value: self.profile.get('id')});

          formData.append('_method','patch');
        }

        for( i = 0; i < data.length; i++ )
        {
          formData.append(data[i].name,data[i].value);
        }
      });

      self.dropzone.on('error',function(file,errors,xhr) {
        this.removeAllFiles(true);

        if( xhr.status === 422 ) {
          showErrors(xhr);
        }

        else {
          ServerError(xhr);
        }
      });

      self.dropzone.on('success', function(file, response, xhr) {

        if( self.profile.get('id') )
        {
          swal({
            title: 'Profile Updated!',
            text: 'The profile was successfully updated.',
            type: 'success',
            confirmButtonColor: SUSHI,
            confirmButtonText: OK
          });
        }

        else {
          swal({
            title: 'Profile Created!',
            text: 'The Profile was Successfully Created.',
            type: 'success',
            confirmButtonColor: SUSHI,
            confirmButtonText: OK
          });

          self.profile.set('id',response.profile_id);
        }
      });


    }).error(function(response) {
      ServerError(response);
    });

    return self;
  },

  mustCreateAccount: function(e) {
    e.preventDefault();
    swal('Oops...','Must create account first','error')
  },

  createSettings: function(e) {
    e.preventDefault();

    if( ! this.user.get('id') )
    {
      this.mustCreateAccount(e);
      return;
    }

    var data = objectSerialize(input('.setting-field'));
    data.user_id = this.user.get('id');

    if( this.settings.get('id') ) {
      data.id = this.settings.get('id');
    }

    this.settings.save(data,{
      wait: true,
      success: function(model, response) {

        if( ! model.get('id') ) {
          swal({
            title: 'Settings Creared!',
            text: 'The settings were successfully created.',
            type: 'success',
            confirmButtonColor: SUSHI,
            confirmButtonText: OK,
            closeOnConfirm: true
          });

          model.set('id',response.settings_id);
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

    if( ! this.user.get('id') ) {
      this.mustCreateAccount(e);
      return;
    }

    if( this.dropzone.getQueuedFiles().length > 0 )
    {
      this.dropzone.processQueue();
    }

    else
    {
      var data = objectSerialize(input('.profile-field'));
      data.user_id = this.user.get('id');

      if( this.profile.get('id') )
      {
        data.id = this.profile.get('id');
      }

      this.profile.save(data, {
        wait: true,
        success: function(model, response) {

          if( ! model.get('id') ) {
            swal({
              title: 'Profile Created!',
              text: 'The profile was successfully created.',
              type: 'success',
              confirmButtonColor: SUSHI,
              confirmButtonText: OK,
              closeOnConfirm: true,
              closeOnCancel: true
            });

            model.set('id',response.profile_id);
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
    }
  },

  createAccount: function(e) {

    e.preventDefault();

    var data = objectSerialize(input('.user-field'));
    data.user_id = this.user.get('id');

    if( this.profile.get('id') )
    {
      data.id = this.profile.get('id');
    }

    this.user.save(data,{
      wait: true,
      success: function(model, response) {
        swal({
          title: 'User Created!',
          text: 'The User was Successfully Created.',
          type: 'success',
          confirmButtonColor: SUSHI,
          confirmButtonText: OK
        });

        model.set('id',response.user_id);
      },

      error: function(model, response) {
        showErrors(response);
      }
    });
  }
});
