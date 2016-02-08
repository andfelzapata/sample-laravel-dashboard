<div class="modal fade" id="addPestModal" role="dialog" aria-labelledby="addPestModalLabel" style="display: none;">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content modal-lg">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title" id="addPestModalLabel">Associate New Pest</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Pest Name</label>
                    <input class="form-control" id="pest-name" name="pest-name" type="text">
                    <span class="validation-error"></span>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button id="pest-add" type="button" class="btn btn-primary">Add</button>
            </div>
        </div>
    </div>
</div>