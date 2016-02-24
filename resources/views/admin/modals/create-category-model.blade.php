<div class="modal fade" id="createCategoryModal" role="dialog" aria-labelledby="createCategoryModalLabel" style="display: none;">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title" id="createCategoryModalLabel">Create New Category</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Category Name</label>
                    <input class="form-control" id="category-name" name="category-name" type="text">
                    <span class="validation-error"></span>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button id="category-create" type="button" class="btn btn-primary">Create</button>
            </div>
        </div>
    </div>
</div>