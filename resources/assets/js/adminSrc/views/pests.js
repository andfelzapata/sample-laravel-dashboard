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

        DashboardPartial.get(url).done(function(response){
            self.$el.html(response);

        }).error(function(response) {
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
                confirmButtonColor: SUSHI,
                confirmButtonText: "Yes, delete it!",
                closeOnConfirm: false },
            function() {

                self.deletePest(e);

            });
    },

    deletePest: function(e) {;
        e.preventDefault();
        var id = $(e.currentTarget).siblings("#pestId").data('pest-id');

        this.model.set({id: id});

        this.model.destroy({
            wait: true,
            success: function(model, response) {
                swal({
                        title: 'Delete Successful',
                        text: 'Successfully deleted this pest',
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
                    text: 'Something went wrong deleting this pest',
                    type: 'error',
                    confirmButtonColor: SUSHI,
                    confirmButtonText: OK
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
        "click .remove-field": "removeImageField",
        "click #add-procedure": "addProcedures",
        "click #add-plant": "addPlants",
        "click .plant-create-procedure": "plantCreateProcedure",
        "click .plant-create-plant": "plantCreatePlant",
        "click .remove-procedure": "removeProcedure",
        "click .remove-plant": "removePlant",
        "click #procedure-add-all": "associateProcedures",
        "click #plant-add-all": "associatePlants",
        "click .close-modal": "clearTable",
    },

    render: function(url) {
        var self = this;

        DashboardPartial.get(url).done(function(response){
            self.$el.html(response);

        }).error(function(response) {
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
                        confirmButtonColor: SUSHI,
                        confirmButtonText: OK
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

    addProcedures: function(e) {
        $('#addProcedureModal').modal("show");
    },

    addPlants: function(e) {
        $('#addPlantModal').modal("show");
    },

    plantCreateProcedure: function(e) {
        window.open('#procedures/create', '');
    },

    plantCreatePlant: function(e) {
        window.open('#plants/create', '');
    },

    removeProcedure: function(e) {
        $(e.target).closest('tr').remove();
    },

    removePlant: function(e) {
        $(e.target).closest('tr').remove();
    },

    associateProcedures: function(e) {
        var rows = $("#procedure-table tbody tr").clone();
        $("#proceduresTableContainer table tbody").append(rows);
        $("#procedure-table").children('tbody').html("");
        $('#addProcedureModal').modal('hide');
    },

    associatePlants: function(e) {
        var rows = $("#plant-table tbody tr").clone();
        $("#plantsTableContainer table tbody").append(rows);
        $("#plant-table").children('tbody').html("");
        $('#addPlantModal').modal('hide');
    },

    clearTable: function(e) {
        $(e.target).parent().siblings('.modal-body').find('table tbody').html("");
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
        "click #update-pest": "updatePest",
        "click .pest-create-procedure": "pestCreateProcedure",
        "click .pest-create-pest": "pestCreatePlant",
        "click #add-procedure": "addProcedures",
        "click #add-plant": "addPlants",
        "click .remove-procedure": "removeProcedure",
        "click .remove-plant": "removePlant",
        "click #procedure-add-all": "associateProcedures",
        "click #plant-add-all": "associatePlants",
        "click .close-modal": "clearTable",
        "click .edit-procedure": "editProcedure",
        "click .edit-plant": "editPlant"
    },

    render: function(url) {
        var self = this;

        DashboardPartial.get(url).done(function(response){

            self.$el.html(response);

        }).error(function(response) {

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
                        confirmButtonColor: SUSHI,
                        confirmButtonText: OK
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

    addProcedures: function(e) {
        $('#addProcedureModal').modal("show");
    },

    addPlants: function(e) {
        $('#addPlantModal').modal("show");
    },

    pestCreateProcedure: function(e) {
        window.open('#procedures/create', '');
    },

    pestCreatePlant: function(e) {
        window.open('#plants/create', '');
    },

    editProcedure: function(e) {
        var id = $(e.target).siblings('input').val();
        window.open('#procedures/'+id+'/edit', '');
    },

    editPlant: function(e) {
        var id = $(e.target).siblings('input').val();
        window.open('#plants/'+id+'/edit', '');
    },

    removeProcedure: function(e) {
        $(e.target).closest('tr').remove();
    },

    removePlant: function(e) {
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
