<div class="modal fade" id="sponsorModal" role="dialog" aria-labelledby="sponsorModalLabel" style="display: none;">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title" id="sponsorModalLabel">Create New Sponsor</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Name</label>
                    <input class="form-control" id="sponsor-name" name="name" type="text">
                    <span class="validation-error"></span>
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input class="form-control" id="sponsor-email" name="email" type="text">
                    <span class="validation-error"></span>
                </div>
                <div class="form-group">
                    <label>Url</label>
                    <input class="form-control" id="sponsor-url" name="url" type="text">
                    <span class="validation-error"></span>
                </div>
                <div class="form-group">
                    <label>Description</label>
                    <input class="form-control" id="sponsor-description" name="description" type="text">
                    <span class="validation-error"></span>
                </div>
                <div class="form-group">
                    <label>Active From</label>
                    <input class="form-control" id="sponsor-active-from" name="active_from" type="date">
                    <span class="validation-error"></span>
                </div>
                <div class="form-group">
                    <label>Active To</label>
                    <input class="form-control" id="sponsor-active-to" name="active_to" type="date">
                    <span class="validation-error"></span>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button id="sponsor-create" type="button" class="btn btn-primary">Create</button>
            </div>
        </div>
    </div>
</div>