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
    },

    events: {
        'click .delete-plant': "confirmDelete"
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

/***********************************
 * Return edit  culinary plant view.
 ***********************************/
var EditCulinaryPlantView = Backbone.View.extend({

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
