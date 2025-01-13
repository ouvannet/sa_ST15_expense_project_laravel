<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="addCategoryLabel">Add Category</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form id="addCategoryForm">
                @csrf
                <input type="hidden" name="category_id" value="{{$category->id}}">
                <div class="mb-3">
                    <label for="add-name" class="form-label">Name</label>
                    <input type="text" class="form-control" value="{{$category->name}}" name="name" required>
                </div>
                <div class="mb-3">
                    <label for="add-description" class="form-label">Description</label>
                    <input type="text" class="form-control" value="{{$category->description}}" name="description">
                </div>
                <div class="d-grid">
                    <button type="submit" id="btn_submit_edit_category" class="btn btn-success">Update Category</button>
                </div>
            </form>
        </div>
    </div>
</div>

