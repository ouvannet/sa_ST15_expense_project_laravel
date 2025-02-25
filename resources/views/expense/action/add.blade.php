<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="addExpenseLabel">Add Expense</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form id="addExpenseForm">
                @csrf
                <div class="row">
                    <!-- Category -->
                    <div class="col-md-6 mb-3">
                        <label for="category" class="form-label">Category</label>
                        <select class="form-select" id="category" required>
                            <option value="" disabled selected>Select Category</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <!-- User -->
                    <div class="col-md-6 mb-3">
                        <label for="user" class="form-label">User</label>
                        <select class="form-select" id="user" required>
                            <option value="" disabled selected>Select User</option>


                            @foreach ($users as $user)
                                @if ($user->role_id != 1)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endif
                            @endforeach

                        </select>
                    </div>
                    <!-- Budget -->
                    <div class="col-md-6 mb-3">
                        <label for="budget" class="form-label">Budget</label>
                        <input type="number" class="form-control" id="budget" required>
                    </div>


                    <!-- Attachment -->
                    <div class="col-md-6 mb-3">
                        <label for="attachment" class="form-label">Attachment</label>
                        <input type="file" class="form-control" id="attachment">
                    </div>
                    <!-- Status -->
                    <div class="col-md-6 mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-select" id="status" required>
                            <option value="" disabled selected>Select Status</option>
                            <option value="Pending">Pending</option>
                            <option value="Approved">Approved</option>
                            <option value="Rejected">Rejected</option>
                        </select>
                    </div>
                    <!-- Assign -->
                    <div class="col-md-6 mb-3">
                        <label for="assign" class="form-label">Assign to</label>

                        <select class="form-select" id="assign" required>
                            <option value="" disabled selected>Select admin</option>
                            @foreach ($users as $user)
                                @if ($user->role_id == 1)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endif
                            @endforeach
                        </select>



                        </select>
                    </div>
                    <!-- Description -->
                    <div class="col-md-6 mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" rows="4" required></textarea>
                    </div>
                    <!-- Date -->
                    <div class="col-md-6 mb-3">
                        <label for="date" class="form-label">Date</label>
                        <input type="date" class="form-control" id="date" required>
                    </div>

                </div>
                <div class="text-end">
                    <button id="btn_submit_expense" type="button" class="btn btn-success">Add
                        Expense</button>
                </div>
            </form>
        </div>
    </div>
</div>
