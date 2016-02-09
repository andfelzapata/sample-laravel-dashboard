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

    var json = response.responseJSON;
    var text = JSON.parse(response.responseText);

    var errors = typeof json !== 'undefined' ? json : text;

    _.each(errors, function(num, key) {
        console.log(num);
        assignErrorToField(num, key);
    });

});

/**
 * Initialize twitter typeahead input.
 * @param url: url of desired resource search service.
 * @param query: query for database search.
 * @param displayKey: object key of result to be displayed.
 * @param callback: function to execute on suggestion select.
 */
function TypeAhead(inputElement, url, query, displayKey, callback) {

    var config = {};

    var _setConfig = function (url, query, displaykey, callback) {
        config.url = url;
        config.query = query;
        config.displayKey = displaykey;
        config.callback = callback;
    };

    var _startEngine = function () {
        var engine = new Bloodhound({
            remote: {
                cache: false,
                url: config.url+'?'+config.query+'=%QUERY',
                wildcard: '%QUERY',
            },

            datumTokenizer: Bloodhound.tokenizers.whitespace(config.displayKey),
            queryTokenizer: Bloodhound.tokenizers.whitespace
        });

        engine.initialize();

        config.engine = engine;
    }

    var _initSearch = function (inputElement) {

        $(inputElement).typeahead({
            highlight: true,
            hint: false,
            minLength: 2
        }, {
            name: 'engine',
            limit: 10,
            displayKey: config.displayKey,
            source: config.engine.ttAdapter(),
            templates: {
                empty: [
                    '<div class="empty-suggestion-message">',
                    'No results matched your query.',
                    '</div>'
                ].join('\n'),
                suggestion: Handlebars.compile('<p> <span>{{name}}</span> </p>'),
            }
        }).bind('typeahead:select', function(ev, suggestion) {

            $(inputElement).typeahead('val','');

            config.callback(suggestion);

        });

    };

    _setConfig(url,query,displayKey, callback);
    _startEngine();
    _initSearch(inputElement);
};

/**
 * HandleBars Shortcut.
 *
 * @param templateId
 * @param context
 * @returns {*}
 * @constructor
 */
function HandlebarsCompile(templateId, context){

    var source   = $(templateId).html();

    var template = Handlebars.compile(source);

    return template(context);

};

/**
 * Add row dinamically to table.
 *
 * @param tableId
 * @param html
 * @constructor
 */
function AddRow(tableId, html){

    $(tableId).children("tbody").append(html);

};
/**
 * Alert Model
 */
var Alert = Backbone.Model.extend({
    urlRoot: 'alerts'
});

/**
 * Category Model
 */
var Category = Backbone.Model.extend({
    urlRoot: 'categories'
});

/**
 * Culinary Plant Model
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
 * Pest Model
 */
var Pest = Backbone.Model.extend({
    urlRoot: 'pests'
});

/**
 * Plant Model
 */
var Plant = Backbone.Model.extend({
    urlRoot: 'plants'
});

/**
 * Procedure Model
 */
var Procedure = Backbone.Model.extend({
    urlRoot: 'procedures'
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
 * Term Model
 */
var Term = Backbone.Model.extend({
    urlRoot: 'glossary'
});

/**
 * User Model
 */
var User = Backbone.Model.extend({
    urlRoot: 'users'
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
/*
 * Return plant category view.
 */
var PlantCategoriesView = Backbone.View.extend({
});

/*
 *  
 * Return procedure categories view.
 */
var ProcedureCategoriesView = Backbone.View.extend({
});

/*
 * Return procedure categories view.
 *
 */
var PestCategoriesView = Backbone.View.extend({
});

/**
 * Return categories view.
 */
var CategoriesView = Backbone.View.extend({
    events: {
        "click .create-category":"clickCreateCategory",
        "click .delete-category": function(e) { this.clickDeleteCategory(e,this.model); }
    },

    initialize: function(ob) {
        var url = ob.route;
        this.model = ob.model;
        this.plantCategoriesView = new PlantCategoriesView();
        this.procedureCategoriesView = new ProcedureCategoriesView();
        this.pestCategoriesView = new PestCategoriesView();
        this.render(url);
    },

    render: function(url) {
        var self = this;

        DashboardPartial.get(url).done(function(partial){
            self.$el.html(partial);
            self.plantCategoriesView.setElement(self.$('.plant-categories')).render();
            self.procedureCategoriesView.setElement(self.$('.procedure-categories')).render();
            self.pestCategoriesView.setElement(self.$('.pest-categories')).render();
        }).error(function(partial) {
            ServerError();
        });

        return self;
    },

    clickCreateCategory: function(e) {
        e.preventDefault();
        AppRouter.navigate('categories/create', {trigger:true} );
    },

    clickDeleteCategory:  function (e,model) {
        e.preventDefault();

        var id = $(e.currentTarget).data('category-id').toString();

        model.set('id',id);

        swal({
                title: 'Are you sure?',
                text: 'You are about to delete this category!',
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
                                    text: 'Successfully deleted this category',
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
                                text: 'Something went wrong deleting this category',
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
 * Return create category view.
 */
var CreateCategoryView = Backbone.View.extend({
    events: {
        "click #createCategory":"clickCreateCategory"
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

    clickCreateCategory: function(e) {
        e.preventDefault();

        var data = objectSerialize(input('.category-field'));

        this.model.save(data, {
            wait: true,
            success:function(model, response) {
                swal({
                        title: 'Category Created!',
                        text: 'The category '+model.get('category')+'  successfully created.',
                        type: 'success',
                        confirmButtonColor: "#8DC53E",
                        confirmButtonText: "Ok"
                    },
                    function() {
                        AppRouter.navigate('categories', {trigger:true} );
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
 * Return edit category view.
 */
var EditCategoryView = Backbone.View.extend({
    events: {
        "click #updateCategory":"clickUpdateCategory"
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

    clickUpdateCategory: function(e) {
        e.preventDefault();

        var data = objectSerialize(input('.category-field'));

        this.model.save(data, {
            wait: true,
            success:function(model, response) {
                swal({
                        title: 'Category Updated!',
                        text: 'The category '+model.get('category')+'  successfully updated.',
                        type: 'success',
                        confirmButtonColor: "#8DC53E",
                        confirmButtonText: "Ok"
                    },
                    function() {
                        AppRouter.navigate('categories', {trigger:true} );
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
        "click .remove-field": "removeImageField",
        "click #add-procedure": "addProcedure",
        "click #add-pest": "addPest"

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
    },

    addProcedure: function(e) {

    },

    addPest: function(e) {

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

/**
 * Return glossary edit glossary term
 */
var EditGlossaryView = Backbone.View.extend({
    
    events: {
        'click #updateGlossary': 'clickUpdateGlossary'
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
            Dropzone.autoDiscover = false;
            self.dropzone = new Dropzone("div#file-upload",{ 
                                                                paramName: "image", 
                                                                method: "post",
                                                                url: "glossary",
                                                                maxFilesize: 2,
                                                                addRemoveLinks: true,
                                                                maxFiles: 1,
                                                                acceptedFiles: "image/*",
                                                                autoProcessQueue: false,
                                                                dictDefaultMessage: "Drag and drop your image here",
                                                                headers: {
                                                                    'X-CSRF-Token': input('input[name="_token"]')[0].value
                                                                }
                                                            });

            self.dropzone.on('processing',function(file) {
                var id = input('input[name="id"]')[0].value;
                this.options.url = "/admin/dashboard/glossary/"+id;
            });

            self.dropzone.on('sending',function(file, xhr, formData) {
                var data = input('.glossary-field');
                
                formData.append('_method','patch');

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
                        title: "Term Updated",
                        text: "Successfully updated glossary term",
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

    clickUpdateGlossary: function(e) {
        e.preventDefault();

        if( this.dropzone.getQueuedFiles().length > 0 )
        {
            this.dropzone.processQueue();
        }
        else
        {
            var data = objectSerialize(input('.glossary-field'));

            this.model.save(data,{
                wait: true,
                success: function(model, response) {
                    swal({
                        title: "Term Updated",
                        text: "Successfully updated glossary term",
                        type: "success",
                        confirmButtonText: OK,
                        confirmButtonColor: SUSHI,
                        closeOnConfirm: true
                    }, function() {
                        AppRouter.navigate('glossary', {trigger:true} );
                    });
                },

                error: function(model, response) {
                    showErrors(response);
                }
            });
        }
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
        "click .remove-field": "removeImageField",
        "click .plant-create-procedure": "plantCreateProcedure",
        "click .plant-create-pest": "plantCreatePest",
        "click #add-procedure": "addProcedures",
        "click #add-pest": "addPests",
        "click .remove-procedure": "removeProcedure",
        "click .remove-pest": "removePest",
        "click #procedure-add-all": "associateProcedures",
        "click #pest-add-all": "associatePests",
        "click .close-modal": "clearTable",
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
    },

    addProcedures: function(e) {
        $('#addProcedureModal').modal("show");
    },

    addPests: function(e) {
        $('#addPestModal').modal("show");
    },

    plantCreateProcedure: function(e) {
        window.open('#procedures/create', '');
    },

    plantCreatePest: function(e) {
        window.open('#pests/create', '');
    },

    removeProcedure: function(e) {
        $(e.target).closest('tr').remove();
    },

    removePest: function(e) {
        $(e.target).closest('tr').remove();
    },

    associateProcedures: function(e) {
        var rows = $("#procedure-table tbody tr").clone();
        $("#proceduresTableContainer table tbody").append(rows);
        $("#procedure-table").children('tbody').html("");
        $('#addProcedureModal').modal('hide');
    },

    associatePests: function(e) {
        var rows = $("#pest-table tbody tr").clone();
        $("#pestsTableContainer table tbody").append(rows);
        $("#pest-table").children('tbody').html("");
        $('#addPestModal').modal('hide');
    },

    clearTable: function(e) {
        $(e.target).parent().siblings('.modal-body').find('table tbody').html("");
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
        "click #update-plant": "updatePlant",
        "click .plant-create-procedure": "plantCreateProcedure",
        "click .plant-create-pest": "plantCreatePest",
        "click #add-procedure": "addProcedures",
        "click #add-pest": "addPests",
        "click .remove-procedure": "removeProcedure",
        "click .remove-pest": "removePest",
        "click #procedure-add-all": "associateProcedures",
        "click #pest-add-all": "associatePests",
        "click .close-modal": "clearTable",
        "click .edit-procedure": "editProcedure",
        "click .edit-pest": "editPest"
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

    addProcedures: function(e) {
        $('#addProcedureModal').modal("show");
    },

    addPests: function(e) {
        $('#addPestModal').modal("show");
    },

    plantCreateProcedure: function(e) {
        window.open('#procedures/create', '');
    },

    plantCreatePest: function(e) {
        window.open('#pests/create', '');
    },

    editProcedure: function(e) {
        var id = $(e.target).siblings('input').val();
        window.open('#procedures/'+id+'/edit', '');
    },

    editPest: function(e) {
        var id = $(e.target).siblings('input').val();
        window.open('#pests/'+id+'/edit', '');
    },

    removeProcedure: function(e) {
        $(e.target).closest('tr').remove();
    },

    removePest: function(e) {
        $(e.target).closest('tr').remove();
    },

    associateProcedures: function(e) {
        var alert = '<a class="btn btn-sm btn-warning procedure-alert">Alert</a> ';
        var edit = '<a class="btn btn-sm btn-success edit-procedure">Edit</a> ';

        var rows = $("#procedure-table tbody tr").clone();
        _.each(rows, function(element, index, list) {
            $(element).find('.actions').prepend(edit);
            $(element).find('.actions').prepend(alert);
        });

        $("#proceduresTableContainer table tbody").append(rows);
        $("#procedure-table").children('tbody').html("");
        $('#addProcedureModal').modal('hide');
    },

    associatePests: function(e) {
        var edit = '<a class="btn btn-sm btn-success edit-pest">Edit</a> ';

        var rows = $("#pest-table tbody tr").clone();
        _.each(rows, function(element, index, list) {
            console.log(element);
            $(element).find('.actions').prepend(edit);
        });

        $("#pestsTableContainer table tbody").append(rows);
        $("#pest-table").children('tbody').html("");
        $('#addPestModal').modal('hide');
    },

    clearTable: function(e) {
        $(e.target).parent().siblings('.modal-body').find('table tbody').html("");
    }
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
    culinaryPlantEditView: null,
    culinaryPlantCreateView: null,
    /**
     * Procedures
     */
    procedureLibraryView: null,
    procedureAddView: null,
    procedureEditView: null,
    /**
     * Alerts
     */
    alertLibraryView: null,
    alertAddView: null,
    alertEditView: null,
    /**
     * Pests
     */
    pestLibraryView: null,
    pestCreateView: null,
    pestEditView: null,
    /**
     *
     */
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
        "pests/create": "createPest",
        "pests/:id/edit": "editPest",
        /**
         * Procedures Routes
         */
        "procedures": "showProcedureLibrary",
        "procedures/create": "createProcedure",
        "procedures/:id/edit": "editProcedure",
        /**
         * Alerts Routes
         */
        "alerts": "showAlertLibrary",
        "alerts/create": "createAlert",
        "alerts/:id/edit": "editAlert",
        /**
         * Web Pages Routes
         */
        "pages": "showWebsitePages",
        /**
         * Categories Routes
         */
        "categories": "showCategories",
        "categories/create": "createCategory",
        "categories/:id/edit":"editCategory",
        "categories?page:num": "showCategories",

        /**
         * Journals Routes
         */
        "journals": "showJournal",
        /**
         * Glossary Routes
         */
        "glossary": "showGlossary",
        "glossary?page:num":"showGlossary",
        "glossary/create":"createGlossary",
        "glossary/:id/edit":"editGlossary",
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
     * Show Application Users
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

        this.culinaryPlantCreateView = new CreateCulinaryPlantView({ model:  model, route: this.baseUrl + url });

        this.container.ChildView = this.culinaryPlantCreateView;
        this.container.render();
    },

    editCulinaryPlant: function() {
        var url = Backbone.history.location.hash.substr(1);
        var model = new CulinaryPlant();

        this.culinaryPlantEditView = new EditCulinaryPlantView({ model: model, route: this.baseUrl + url });

        this.container.ChildView = this.culinaryPlantEditView;
        this.container.render();
    },

    /****************************
     * Pest Library Views
     ****************************/
    showPestLibrary: function () {
        var url = Backbone.history.location.hash.substr(1);
        var model = new Pest();
        this.pestLibraryView = new PestLibraryView({model: model, route: this.baseUrl + url });

        this.container.ChildView = this.pestLibraryView;
        this.container.render();
    },

    createPest: function() {
        var url = Backbone.history.location.hash.substr(1);
        var model = new Pest();

        this.pestCreateView = new CreatePestView({ model:  model, route: this.baseUrl + url });

        this.container.ChildView = this.pestCreateView;
        this.container.render();
    },

    editPest: function() {
        var url = Backbone.history.location.hash.substr(1);
        var model = new Pest();

        this.pestEditView = new EditPestView({ model: model, route: this.baseUrl + url });

        this.container.ChildView = this.pestEditView;
        this.container.render();
    },

    /****************************
     * Procedure Library Views
     ****************************/
    showProcedureLibrary: function () {
        var url = Backbone.history.location.hash.substr(1);
        var model = new Procedure();

        this.procedureLibraryView = new ProcedureLibraryView({ model: model, route: this.baseUrl + url });

        this.container.ChildView = this.procedureLibraryView;
        this.container.render();
    },

    createProcedure: function() {
        var url = Backbone.history.location.hash.substr(1);
        var model = new Procedure();

        this.procedureCreateView = new CreateProcedureView({ model:  model, route: this.baseUrl + url });

        this.container.ChildView = this.procedureCreateView;
        this.container.render();
    },

    editProcedure: function() {
        var url = Backbone.history.location.hash.substr(1);
        var model = new Procedure();

        this.procedureEditView = new EditProcedureView({ model: model, route: this.baseUrl + url });

        this.container.ChildView = this.procedureEditView;
        this.container.render();
    },


    /****************************
     * Alert Library Views
     ****************************/
    showAlertLibrary: function () {
        var url = Backbone.history.location.hash.substr(1);
        var model = new Alert();

        this.alertLibraryView = new AlertLibraryView({ model: model, route: this.baseUrl + url });

        this.container.ChildView = this.alertLibraryView;
        this.container.render();
    },

    createAlert: function() {
        var url = Backbone.history.location.hash.substr(1);
        var model = new Alert();

        this.alertCreateView = new CreateAlertView({ model:  model, route: this.baseUrl + url });

        this.container.ChildView = this.alertCreateView;
        this.container.render();
    },

    editAlert: function() {
        var url = Backbone.history.location.hash.substr(1);
        var model = new Alert();

        this.alertEditView = new EditAlertView({ model: model, route: this.baseUrl + url });

        this.container.ChildView = this.alertEditView;
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
        var model = new Category();
        this.categoriesView = new CategoriesView({ model: model, route: this.baseUrl + url });

        this.container.ChildView = this.categoriesView;
        this.container.render();
    },

    createCategory: function () {
        var url = Backbone.history.location.hash.substr(1);
        var model = new Category();

        this.categoryCreateView = new CreateCategoryView({ model: model, route: this.baseUrl + url });

        this.container.ChildView = this.categoryCreateView;
        this.container.render();
    },

    editCategory: function() {
        var url = Backbone.history.location.hash.substr(1);
        var model = new Category();

        this.categoryEditView = new EditCategoryView({ model: model, route: this.baseUrl + url });

        this.container.ChildView = this.categoryEditView;
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
        var url = Backbone.history.location.hash.substr(1); 
        var model = new Term();
        this.glossaryView = new GlossaryView({ model: model, route: this.baseUrl + url });

        this.container.ChildView = this.glossaryView;
        this.container.render();
    },

    createGlossary: function() {
        var url = Backbone.history.location.hash.substr(1); 
        var model = new Term();
        this.glossaryCreateView = new CreateGlossaryView({ model: model, route: this.baseUrl + url });

        this.container.ChildView = this.glossaryCreateView;
        this.container.render();
    },

    editGlossary: function() {
        var url = Backbone.history.location.hash.substr(1); 
        var model = new Term();
        this.glossaryEditView = new EditGlossaryView({ model: model, route: this.baseUrl + url });

        this.container.ChildView = this.glossaryEditView;
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

/* COLORS */
var SUSHI = "#8DC53E";

/* TEXT */
var OK = "Ok";


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
