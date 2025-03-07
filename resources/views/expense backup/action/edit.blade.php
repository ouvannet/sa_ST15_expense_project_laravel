<div class="modal fade" id="editExpenseModal" tabindex="-1" aria-labelledby="editExpenseLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editExpenseLabel">Edit Expense</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editExpenseForm">
                    <div class="row">

                        <input type="hidden" id="edit-expense-id">
                        <div class="col-md-6 mb-3">
                            <label for="edit-category" class="form-label">Category</label>
                            <select class="form-select" id="edit-category" required>
                                <option value="" disabled>Select Category</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="edit-user" class="form-label">User</label>
                            <select class="form-select" id="edit-user" required>
                                <option value="" disabled>Select User</option>

                                @foreach ($users as $user)
                                    @if ($user->role_id != 1)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="edit-budget" class="form-label">Budget</label>
                            <input type="number" class="form-control" id="edit-budget" required>
                        </div>
                        {{-- <div class="col-md-6 mb-3">
                            <label for="edit-balance" class="form-label">Budget Balance</label>
                            <input type="number" class="form-control" id="edit-balance" required>
                        </div> --}}
                        <input type="hidden" class="form-control" id="edit-budget" required>
                        <div class="col-md-6 mb-3">
                            <label for="edit-description" class="form-label">Description</label>
                            <input type="text" class="form-control" id="edit-description" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="edit-attachment" class="form-label">Attachment</label>
                            <input type="text" class="form-control" id="edit-attachment" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="edit-status" class="form-label">Status</label>
                            <select class="form-select" id="edit-status" required>
                                <option value="" disabled selected>Select Status</option>
                                <option value="Pending">Pending</option>
                                <option value="Approved">Approved</option>
                                <option value="Canceled">Canceled</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="edit-assign" class="form-label">Assign To</label>
                            <select class="form-select" id="edit-assign" required>
                                <option value="" disabled>Select admin</option>
                                @foreach ($users as $user)
                                    @if ($user->role_id == 1)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="edit-date" class="form-label">Date</label>
                            <input type="date" class="form-control" id="edit-date" required>
                        </div>
                        <button type="submit" class="btn btn-success">Update Expense</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
