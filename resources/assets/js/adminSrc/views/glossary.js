
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
