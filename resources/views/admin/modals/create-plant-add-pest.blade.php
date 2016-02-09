<div class="modal fade" id="addPestModal" role="dialog" aria-labelledby="addPestModalLabel" style="display: none;">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title" id="addPestModalLabel">Associate New Pest</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <div>
                        <input class="form-control pull-left" id="findPest" placeholder="Search:" type="text">
                        <a class="btn btn-success plant-create-pest pull-right" target="_blank">Create New Pest</a>
                    </div>

                    <table id="pest-table" class="table table-condensed table-hover table-striped">
                        <thead>
                        <tr>
                            <th>Pest Name</th>
                            <th>Latin Name</th>
                            <th>Creation Date</th>
                            <th>Severity</th>
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
                <button id="pest-add-all" type="button" class="btn btn-success">Add</button>
            </div>
        </div>
    </div>
</div>

@include('admin.partials.handlebars.add-pest-row')

<script type="text/javascript">

    TypeAhead('#findPest', 'search/pests', 'pest', 'name', function(suggestion){

        var html = HandlebarsCompile("#pest-row-template", {
            name: suggestion.name,
            latin_name: suggestion.latin_name,
            created_at: suggestion.created_at,
            severity: suggestion.severity.severity,
            id: suggestion.id
        });

        AddRow("#pest-table", html);

    });

</script>