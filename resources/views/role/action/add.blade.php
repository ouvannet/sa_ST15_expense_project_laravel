<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="addExpenseLabel">Add Role</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form id="addroleForm">
                @csrf
                <div class="row">
                    <!-- Budget -->
                    <div class="col-md-12 mb-3">
                        <label for="budget" class="form-label">Name</label>
                        <input name="name" type="text" class="form-control" required>
                    </div>
                </div>
                <div class="text-end">
                    <button id="btn_submit_add_role" type="button" class="btn btn-success">Add Role</button>
                </div>
            </form>
        </div>
    </div>
</div>