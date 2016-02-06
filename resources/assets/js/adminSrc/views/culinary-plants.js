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
