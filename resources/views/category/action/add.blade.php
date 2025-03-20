<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="addCategoryLabel">Add Category</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form id="addCategoryForm">
                @csrf
                <div class="mb-3">
                    <label for="add-name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="add-name" name="name" required>
                    <div class="invalid-feedback">Please enter a category name (max 255 characters).</div>
                </div>
                <div class="mb-3">
                    <label for="add-description" class="form-label">Description</label>
                    <input type="text" class="form-control" id="add-description" name="description">
                    <div class="invalid-feedback">Description must be 255 characters or less.</div>
                </div>
                <div class="d-grid">
                    <button type="submit" id="btn_submit_category" class="btn btn-success">Add Category</button>
                </div>
            </form>
        </div>
    </div>
</div>





