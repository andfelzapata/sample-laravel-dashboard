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

        DashboardPartial.get(url).done(function(response){
            self.$el.html(response);

        }).error(function(response) {
            ServerError(response);
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
                confirmButtonColor: SUSHI,
                confirmButtonText: "Yes, delete it!",
                closeOnConfirm: false },
            function() {

                self.deleteProcedure(e);

            });
    },

    deleteProcedure: function(e) {;
        e.preventDefault();
        var id = $(e.currentTarget).siblings("#procedureId").data('procedure-id');

        this.model.set({id: id});

        this.model.destroy({
            wait: true,
            success: function(model, response) {
                swal({
                        title: 'Delete Successful',
                        text: 'Successfully deleted this procedure',
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
                    text: 'Something went wrong deleting this procedure',
                    type: 'error',
                    confirmButtonColor: SUSHI,
                    confirmButtonText: OK
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
        "click .remove-field": "removeImageField",
        "click #add-plant": "addPlants",
        "click #add-pest": "addPests",
        "click .pest-create-procedure": "procedureCreatePest",
        "click .pest-create-plant": "procedureCreatePlant",
        "click .remove-pest": "removePest",
        "click .remove-plant": "removePlant",
        "click #pest-add-all": "associatePests",
        "click #plant-add-all": "associatePlants",
        "click .close-modal": "clearTable",
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
                        confirmButtonColor: SUSHI,
                        confirmButtonText: OK
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

    addPests: function(e) {
        $('#addPestModal').modal("show");
    },

    addPlants: function(e) {
        $('#addPlantModal').modal("show");
    },

    procedureCreatePlant: function(e) {
        window.open('#plants/create', '');
    },

    procedureCreatePest: function(e) {
        window.open('#pests/create', '');
    },

    removePlant: function(e) {
        $(e.target).closest('tr').remove();
    },

    removePest: function(e) {
        $(e.target).closest('tr').remove();
    },

    associatePlants: function(e) {
        var rows = $("#plant-table tbody tr").clone();
        $("#plantsTableContainer table tbody").append(rows);
        $("#plant-table").children('tbody').html("");
        $('#addPlantModal').modal('hide');
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
 * Return edit procedure view.
 ***********************************/
var EditProcedureView = Backbone.View.extend({

    initialize: function(ob) {
        var url = ob.route;
        this.render(url);
    },

    events: {
        "click #update-procedure": "updateProcedure",
        "click .procedure-create-plant": "procedureCreatePlant",
        "click .procedure-create-pest": "procedureCreatePest",
        "click #add-plant": "addPlants",
        "click #add-pest": "addPests",
        "click .remove-plant": "removePlant",
        "click .remove-pest": "removePest",
        "click #plant-add-all": "associatePlants",
        "click #pest-add-all": "associatePests",
        "click .close-modal": "clearTable",
        "click .edit-plant": "editPlant",
        "click .edit-pest": "editPest"
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
                        confirmButtonColor: SUSHI,
                        confirmButtonText: OK
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

    addPests: function(e) {
        $('#addPestModal').modal("show");
    },

    addPlants: function(e) {
        $('#addPlantModal').modal("show");
    },

    procedureCreatePest: function(e) {
        window.open('#pests/create', '');
    },

    procedureCreatePlant: function(e) {
        window.open('#plants/create', '');
    },

    editPest: function(e) {
        var id = $(e.target).siblings('input').val();
        window.open('#pests/'+id+'/edit', '');
    },

    editPlant: function(e) {
        var id = $(e.target).siblings('input').val();
        window.open('#plants/'+id+'/edit', '');
    },

    removePest: function(e) {
        $(e.target).closest('tr').remove();
    },

    removePlant: function(e) {
        $(e.target).closest('tr').remove();
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

    associatePlants: function(e) {
        var edit = '<a class="btn btn-sm btn-success edit-plant">Edit</a> ';

        var rows = $("#plant-table tbody tr").clone();
        _.each(rows, function(element, index, list) {
            $(element).find('.actions').prepend(edit);
        });

        $("#plantsTableContainer table tbody").append(rows);
        $("#plant-table").children('tbody').html("");
        $('#addPlantModal').modal('hide');
    },

    clearTable: function(e) {
        $(e.target).parent().siblings('.modal-body').find('table tbody').html("");
    }
});
