
/**
 * Return glossary words view.
 */
var GlossaryView = Backbone.View.extend({
    events: {
        "click .delete-term": function(e) { this.onClickDeleteTerm(e,this.model); }
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

    onClickDeleteTerm: function(e,model) {
        e.preventDefault();

        var id = $(e.currentTarget).data('term-id').toString();
        var token = $('#_token').val();

        model.set('id',id);

        swal({
                title: 'Are you sure?',
                text: 'You are about to delete this term!',
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
                        headers: {
                            'X-CSRF-TOKEN': $('#_token').val()
                        },
                        success: function(model, response) {
                            swal({
                                    title: 'Delete Successful',
                                    text: 'Successfully deleted this term',
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
                                text: 'Something went wrong deleting this term',
                                type: 'error',
                                confirmButtonColor: SUSHI,
                                confirmButtonText: OK
                            });
                        }
                    });
                }
            })
        }
});

/**
 * Return glossary create view
 */
var CreateGlossaryView = Backbone.View.extend({
    
    events: {
        'click #createGlossary': 'clickCreateGlossary'
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
            self.dropzone = new Dropzone("div#file-upload",{ 
                                                                paramName: "image", 
                                                                url: "glossary",
                                                                maxFilesize: 2,
                                                                addRemoveLinks: true,
                                                                maxFiles: 1,
                                                                acceptedFiles: "image/*",
                                                                autoProcessQueue: false,
                                                                dictDefaultMessage: "Drag and drop your image here"
                                                            });
            self.dropzone.on('sending',function(file, xhr, formData) {
                var data = input('.glossary-field');

                for( i = 0; i < data.length; i++ )
                {
                    formData.append(data[i].name,data[i].value);
                }
            });

            self.dropzone.on('error',function(file, errors, xhr) {
                this.removeAllFiles(true);
                
                if( xhr.status === 422 ) {
                    showErrors(xhr);
                 }

                 else {
                    ServerError(xhr);
                 }
            });

            self.dropzone.on('success',function(file, response, xhr) {
                    swal({
                        title: "Term Created",
                        text: "Successfully added term to glossary",
                        type: "success",
                        confirmButtonText: OK,
                        confirmButtonColor: SUSHI,
                        closeOnConfirm: true
                    }, function() {
                        AppRouter.navigate('glossary', {trigger:true} );
                    });
            });

        }).error(function(partial) {
            ServerError();
        });

        return self;
    },

    clickCreateGlossary: function(e) {
        e.preventDefault();
        this.dropzone.processQueue();
    }
});
