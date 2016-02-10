<div class="modal fade" id="addPlantModal" role="dialog" aria-labelledby="addPlantModalLabel" style="display: none;">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title" id="addPlantModalLabel">Associate New Plant</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <div>
                        <input class="form-control pull-left" id="findPlant" placeholder="Search:" type="text">
                        <a class="btn btn-success plant-create-plant pull-right" target="_blank">Create New Plant</a>
                    </div>

                    <table id="plant-table" class="table table-condensed table-hover table-striped">
                        <thead>
                        <tr>
                            <th>Plant Name</th>
                            <th>Latin Name</th>
                            <th>Creation Date</th>
                            <th>Category</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>

                        </tbody>

                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default close-modal" data-dismiss="modal">Close</button>
                <button id="plant-add-all" type="button" class="btn btn-success">Add</button>
            </div>
        </div>
    </div>
</div>

@include('admin.partials.handlebars.add-plant-row')

<script type="text/javascript">

    TypeAhead('#findPlant', 'search/plants', 'plant', 'name', function(suggestion){

        var html = HandlebarsCompile("#plant-row-template", {
            name: suggestion.name,
            botanical_name: suggestion.botanical_name,
            created_at: suggestion.created_at,
            category: suggestion.category.category,
            id: suggestion.id
        });

        AddRow("#plant-table", html);

    });

</script>