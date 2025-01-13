<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="addDepartmentLabel">Add Department</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form id="addDepartmentForm">
                @csrf
                <div class="mb-3">
                    <label for="add-name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="add-name" name="name" required>
                </div>
                <div class="mb-3">
                    <label for="add-description" class="form-label">Description</label>
                    <input type="text" class="form-control" id="add-description" name="description">
                </div>
                <div class="d-grid">
                    <button type="submit" id="btn_add_submit_department" class="btn btn-success">Add Department</button>
                </div>
            </form>
        </div>
    </div>
</div>
