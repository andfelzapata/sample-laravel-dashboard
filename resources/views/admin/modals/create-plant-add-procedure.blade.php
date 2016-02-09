<div class="modal fade" id="addProcedureModal" role="dialog" aria-labelledby="addProcedureModalLabel" style="display: none;">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title" id="addProcedureModalLabel">Associate New Procedure</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <div>
                        <input class="form-control pull-left" id="findProcedure" placeholder="Search:" type="text">
                        <a class="btn btn-success plant-create-procedure pull-right" target="_blank">Create New Procedure</a>
                    </div>

                    <table id="procedure-table" class="table table-condensed table-hover table-striped">
                        <thead>
                            <tr>
                                <th>Procedure Name</th>
                                <th>Creation Date</th>
                                <th>Frequency</th>
                                <th>Urgency</th>
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
                <button id="procedure-add-all" type="button" class="btn btn-success">Add</button>
            </div>
        </div>
    </div>
</div>

@include('admin.partials.handlebars.add-procedure-row')

<script type="text/javascript">

    TypeAhead('#findProcedure', 'search/procedures', 'procedure', 'name', function(suggestion){

        var html = HandlebarsCompile("#procedure-row-template", {
            name: suggestion.name,
            created_at: suggestion.created_at,
            frequency: suggestion.frequency.frequency,
            urgency: suggestion.urgency.urgency,
            id: suggestion.id
        });

        AddRow("#procedure-table", html);

    });

</script>