
 <div class="modal-dialog model-lg">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="editExpenseLabel">Edit Expense</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form id="editExpenseForm">
                @csrf
                <div class="row">
                    <input type="hidden" name="expense_id" value="{{ $expense->id }}">

                    <div class="col-md-6 mb-3">
                        <label for="edit-category" class="form-label">Category</label>
                        <select class="form-select" id="edit-category" name="category_id" required>
                            <option value="" disabled>Select Category</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" {{ $expense->categories_id == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="edit-user" class="form-label">User</label>
                        <select class="form-select" id="edit-user" name="user_id" required>
                            <option value="" disabled>Select User</option>
                            @foreach ($users as $user)
                                @if ($user->role_id != 1)
                                    <option value="{{ $user->id }}" {{ $expense->user_id == $user->id ? 'selected' : '' }}>
                                        {{ $user->name }}
                                    </option>
                                @endif
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="edit-budget" class="form-label">Budget</label>
                        <input type="number" class="form-control" id="edit-budget" name="budget" value="{{ $expense->budget }}" required>
                    </div>

                    

                    <div class="col-md-6 mb-3">
                        <label for="edit-balance" class="form-label">Balance</label>
                        <input type="number" class="form-control" id="edit-balance" name="budget_balance" value="{{ $expense->budget_balance }}" readonly>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="edit-description" class="form-label">Description</label>
                        <input type="text" class="form-control" id="edit-description" name="description" value="{{ $expense->description }}" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="edit-attachment" class="form-label">Attachment</label>
                        <input type="text" class="form-control" id="edit-attachment" name="attachment" value="{{ $expense->attachment }}" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="edit-status" class="form-label">Status</label>
                        <select class="form-select" id="edit-status" name="status" required>
                            <option value="" disabled>Select Status</option>
                            <option value="Pending" {{ $expense->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                            <option value="Approved" {{ $expense->status == 'Approved' ? 'selected' : '' }}>Approved</option>
                            <option value="Canceled" {{ $expense->status == 'Canceled' ? 'selected' : '' }}>Canceled</option>
                        </select>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="edit-assign" class="form-label">Assign To</label>
                        <select class="form-select" id="edit-assign" name="assigned_to" required>
                            <option value="" disabled>Select admin</option>
                            @foreach ($users as $user)
                                @if ($user->role_id == 1)
                                    <option value="{{ $user->id }}" {{ $expense->assign == $user->id ? 'selected' : '' }}>
                                        {{ $user->name }}
                                    </option>
                                @endif
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="edit-date" class="form-label">Date</label>
                        <input type="date" class="form-control" id="edit-date" name="date" value="{{ \Carbon\Carbon::parse($expense->date)->format('Y-m-d') }}" required>

                    </div>

                    <button type="button" class="btn btn-success" id="btn_submit_edit_expense">Update Expense</button>
                </div>
            </form>
        </div>
    </div>
</div>
