{{-- 
<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="addRecurringLabel">Create Recurring</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form id="addRecurringForm">
                @csrf

                <!-- Hidden input for selected expense -->
                <input type="hidden" id="expense_id" name="expense_id" required>
                <input type="hidden" id="category_id" name="category_id" required>
                <input type="hidden" id="amount" name="amount" required>

                <!-- Search box -->
                <div class="mb-3">
                    <input type="text" id="searchExpense" class="form-control" placeholder="Search Expense...">
                </div>

                <!-- Expense List -->
                <div class="list-group" id="expenseList" style="max-height: 200px; overflow-y: auto;">
                    @foreach ($expenses as $expense)
                        <button type="button" class="list-group-item list-group-item-action expense-item"
                            data-id="{{ $expense->id }}"
                            data-amount="{{ $expense->budget }}"
                            data-category-id="{{ $expense->categories_id }}">
                            <span class="bg-primary text-white p-1 rounded-full">{{ $expense->reference_number }}</span> | Amount: {{ $expense->budget }} | Status: {{ $expense->status }}
                        </button>
                    @endforeach
                </div>

               



                <div class="mt-3">
                    <strong>Selected Expense:</strong> <span id="selectedExpenseText">None</span>
                </div>

                <!-- Recurring Form Fields -->
                <div class="row mt-3">
                    <div class="col-md-6 mb-3">
                        <label for="frequency" class="form-label">Frequency</label>
                        <select class="form-select" id="frequency" name="frequency" required>
                            <option value="" disabled selected>Select Type</option>
                            <option value="daily">Daily</option>
                            <option value="weekly">Weekly</option>
                            <option value="monthly">Monthly</option>
                            <option value="yearly">Yearly</option>
                        </select>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="start_date" class="form-label">Start Date</label>
                        <input type="date" class="form-control" id="start_date" name="start_date" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="end_date" class="form-label">End Date</label>
                        <input type="date" class="form-control" id="end_date" name="end_date" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-select" id="status" name="status" required>
                            <option value="" disabled selected>Select Status</option>
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                            <option value="canceled">Canceled</option>
                        </select>
                    </div>
                </div>

                <div class="text-end">
                    <button id="btn_submit_recurring" type="button" class="btn btn-success">Save Recurring</button>
                </div>
            </form>
        </div>
    </div>
</div> --}}



<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="addRecurringLabel">Create Recurring</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form id="addRecurringForm">
                @csrf

                <!-- Hidden inputs for selected expense -->
                <input type="hidden" id="expense_id" name="expense_id" required>
                <input type="hidden" id="user_id" name="user_id" required>
                <input type="hidden" id="category_id" name="category_id" required>
                <input type="hidden" id="amount" name="amount" required>

                <!-- Search box -->
                <div class="mb-3">
                    <input type="text" id="searchExpense" class="form-control" placeholder="Search Expense...">
                </div>

                <!-- Expense List -->
                <div class="list-group" id="expenseList" style="max-height: 200px; overflow-y: auto;">
                    @foreach ($expenses as $expense)
                        <button type="button" class="list-group-item list-group-item-action expense-item"
                            data-id="{{ $expense->id }}"
                            data-amount="{{ $expense->budget }}"
                            data-category-id="{{ $expense->categories_id}}"
                            data-user-id="{{ $expense->user_id}}">
                            <span class="bg-primary text-white p-1 rounded-full">{{ $expense->reference_number }}</span>
                            | Amount: {{ $expense->budget }} | Category: {{ $expense->categories_id }}  | User: {{ $expense->user_id }} | Status: {{ $expense->status }}
                        </button>
                    @endforeach
                </div>

                <div class="mt-3">
                    <strong>Selected Expense:</strong> <span id="selectedExpenseText">None</span>
                </div>

                <!-- Recurring Form Fields -->
                <div class="row mt-3">
                    <div class="col-md-6 mb-3">
                        <label for="frequency" class="form-label">Frequency</label>
                        <select class="form-select" id="frequency" name="frequency" required>
                            <option value="" disabled selected>Select Type</option>
                            <option value="daily">Daily</option>
                            <option value="weekly">Weekly</option>
                            <option value="monthly">Monthly</option>
                            <option value="yearly">Yearly</option>
                        </select>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="start_date" class="form-label">Start Date</label>
                        <input type="date" class="form-control" id="start_date" name="start_date" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="end_date" class="form-label">End Date</label>
                        <input type="date" class="form-control" id="end_date" name="end_date" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-select" id="status" name="status" required>
                            <option value="" disabled selected>Select Status</option>
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                            <option value="canceled">Canceled</option>
                        </select>
                    </div>
                </div>

                <div class="text-end">
                    <button id="btn_submit_recurring" type="button" class="btn btn-success">Save Recurring</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    // Ensure each expense item is clickable
    document.querySelectorAll('.expense-item').forEach(item => {
        item.addEventListener('click', function () {
            const expenseId = this.getAttribute('data-id');
            const amount = this.getAttribute('data-amount');
            const categoryId = this.getAttribute('data-category-id');

            // Update hidden fields
            document.getElementById('expense_id').value = expenseId;
            document.getElementById('amount').value = amount;
            document.getElementById('category_id').value = categoryId;

            // Update selected text
            document.getElementById('selectedExpenseText').innerText = `Reference: ${this.textContent.trim()}`;
        });
    });
</script>
