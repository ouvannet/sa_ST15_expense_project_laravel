<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="addExpenseLabel">Edit Permission</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form id="addpermissionForm">
                @csrf
                <input type="hidden" name="permission_id" value="{{$permission->id}}">
                <div class="row">
                    <!-- Budget -->
                    <div class="col-md-12 mb-3">
                        <label for="budget" class="form-label">Name</label>
                        <input name="name" value="{{$permission->name}}" type="text" class="form-control" required>
                    </div>
                </div>
                <div class="text-end">
                    <button id="btn_submit_edit_permission" type="button" class="btn btn-success">Edit Permission</button>
                </div>
            </form>
        </div>
    </div>
</div>