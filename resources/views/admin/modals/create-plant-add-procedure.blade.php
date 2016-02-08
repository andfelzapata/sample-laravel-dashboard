<div class="modal fade" id="addProcedureModal" role="dialog" aria-labelledby="addProcedureModalLabel" style="display: none;">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title" id="addProcedureModalLabel">Associate New Procedure</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <div>
                        <input class="form-control table-filter pull-left" id="procedureFilter" placeholder="Search:" type="text">
                        <a  class="btn btn-sm btn-success plant-create-procedure pull-right">Create New Procedure</a>
                    </div>
                    <script> TableFilter.init('#procedureFilter'); </script>
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
                        <input id="procedureId" type="hidden" data-procedure-id="">
                        <a  class="btn btn-sm btn-success plant-add-procedure">Add</a>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button id="procedure-add" type="button" class="btn btn-success">Add</button>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">

    $("#procedure-table").tablesorter({
        headers: {6: {sorter: false}}
    });

</script>