@extends('layouts.app')
@section('title', 'Expenses')
@section('content')

    <!-- Expenses Table -->
    <div id="expensesTable" class="mb-5">
        <div class="card">
            <div class="card-body">
                <h5 class="mb-3 fw-bold">Expenses List</h5>
                <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addExpenseModal">
                    Add Expense
                </button>

                <table class="table table-striped mb-0">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Reference Number</th>
                            <th scope="col">Category</th>
                            <th scope="col">User</th>
                            <th scope="col">Budget</th>
                            <th scope="col">Balance</th>
                            <th scope="col">Description</th>
                            <th scope="col">Attachment</th>
                            <th scope="col">Status</th>
                            <th scope="col">Assign</th>

                            <th scope="col">Date</th>
                            <th scope="col" class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($expenses as $expense)
                            <tr id="expense-row-{{ $expense->id }}">
                                <td>{{ $loop->iteration }}</td>
                                {{-- <td>{{ $expense->reference_number}}</td> --}}
                                <td>
                                    <a class="text-decoration-none btn btn-sm btn-primary" href="{{ route('expense.show', ['id' => $expense->id]) }}">
                                            {{ $expense->reference_number }}
                                        </a>
                                </td>
                                <td>{{ $expense->category_name }}</td>
                                <td>{{ $expense->user_name }}</td>
                                <td>{{ $expense->budget }}</td>
                                <td>{{ $expense->budget_balance }}</td>
                                <td>{{ $expense->description }}</td>
                                <td>
                                    <a href="{{ $expense->attachment }}" class="btn btn-sm btn-light">
                                        <img src="/images/icon/attachment.png" width="15px">
                                    </a>
                                </td>
                                <td>
                                    <div onclick="changeStatus('{{ $expense->status }}')">
                                        <select
                                            class="form-select update-status-select  {{ $expense->status == 'Approved' ? 'text-success' : ($expense->status == 'Rejected' ? 'text-danger' : 'text-warning') }}"
                                            data-expense-id="{{ $expense->id }}">
                                            <option value="Pending" {{ $expense->status == 'Pending' ? 'selected' : '' }}>
                                                Pending</option>
                                            <option value="Approved"
                                                {{ $expense->status == 'Approved' ? 'selected' : '' }}>Approved</option>
                                            <option value="Rejected"
                                                {{ $expense->status == 'Rejected' ? 'selected' : '' }}>Rejected</option>
                                        </select>
                                    </div>
                                </td>

                                <td>{{ $expense->assign }}</td>
                                <td>{{ \Carbon\Carbon::parse($expense->date)->format('Y-m-d') }}</td>
                                <td class="d-flex justify-content-end gap-2">
                                    <!-- Edit Button -->
                                    <button class="btn btn-sm btn-warning edit-btn py-2 " data-id="{{ $expense->id }}"
                                        data-reference_number={{ $expense->reference_number }}
                                        data-category="{{ $expense->categories_id }}" data-user="{{ $expense->user_id }}"
                                        data-budget="{{ $expense->budget }}" data-balance="{{ $expense->budget_balance }}"
                                        data-description="{{ $expense->description }}"
                                        data-attachment="{{ $expense->attachment }}" data-status="{{ $expense->status }}"
                                        data-assign="{{ $expense->assign }}"
                                        data-date="{{ \Illuminate\Support\Str::before($expense->date, ' ') }}">
                                        Edit
                                    </button>

                                    <!-- Delete Button -->
                                    <button class="btn btn-sm btn-danger delete-btn " data-id="{{ $expense->id }}">
                                        Delete
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="11" class="text-center">No expenses available.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <div class="modal fade" id="UpdateStatusExpenseModal" tabindex="-1" aria-labelledby="addExpenseLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" style="max-width:400px;">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addExpenseLabel">Update Status</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addExpenseForm">
                        <div class="row">
                            <!-- Status -->
                            <div class="col-md-12 mb-3">
                                <label for="status" class="form-label">Status</label>
                                <select class="form-select" id="update_ex_status" required>
                                    <option value="" disabled selected>Select Status</option>
                                    <option value="Pending">Pending</option>
                                    <option value="Approved">Approved</option>
                                    <option value="Rejected">Rejected</option>
                                </select>
                            </div>
                        </div>
                        <div class="text-end">
                            <button type="submit" class="btn btn-success">Update Status</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="addExpenseModal" tabindex="-1" aria-labelledby="addExpenseLabel" aria-hidden="true">
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
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <!-- Budget -->
                            <div class="col-md-6 mb-3">
                                <label for="budget" class="form-label">Budget</label>
                                <input type="number" class="form-control" id="budget" value="111" required>
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
                                <label for="assign" class="form-label">Assign</label>
                                <input type="number" class="form-control" id="assign" required>
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
                            <button id="btn_submit_create_exp" type="button" class="btn btn-success">Add
                                Expense</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Expense Modal -->
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
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="edit-budget" class="form-label">Budget</label>
                                <input type="number" class="form-control" id="edit-budget" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="edit-balance" class="form-label">Budget Balance</label>
                                <input type="number" class="form-control" id="edit-balance" required>
                            </div>
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
                                    <option value="Rejected">Rejected</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="edit-assign" class="form-label">Assign To</label>
                                <input type="number" class="form-control" id="edit-assign" required>
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

    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Confirm Delete</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this expense?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" id="confirmDeleteBtn" class="btn btn-danger">Delete</button>
                </div>
            </div>
        </div>
    </div>

@endsection




@push('js')
    <script>
        // function changeStatus(st) {
        //     $("#update_ex_status").val(st);
        //     $("#UpdateStatusExpenseModal").modal('toggle');
        // }
        let deleteId = null;



        document.getElementById('btn_submit_create_exp').addEventListener('click', function(e) {
            e.preventDefault();

            // Collect form data
            const formData = {
                categories_id: document.getElementById('category').value,
                user_id: document.getElementById('user').value,
                budget: document.getElementById('budget').value,
                budget_balance: document.getElementById('budget').value,
                description: document.getElementById('description').value,
                attachment: document.getElementById('attachment').value,
                status: document.getElementById('status').value,
                assign: document.getElementById('assign').value,
                date: document.getElementById('date').value
            };

            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            // Send data to backend using Fetch API
            fetch('/expense', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify(formData)
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        location.reload(); // Reload page to update table
                    } else {
                        alert('Error: ' + data.message);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        });


        document.querySelectorAll('.update-status-select').forEach(select => {
            select.addEventListener('change', function() {
                const expenseId = this.dataset.expenseId; // Assuming you have a `data-expense-id` attribute
                const newStatus = this.value;

                this.classList.remove('text-success', 'text-danger', 'text-warning');
                if (newStatus === 'Approved') {
                    this.classList.add('text-success');
                } else if (newStatus === 'Rejected') {
                    this.classList.add('text-danger');
                } else if (newStatus === 'Pending') {
                    this.classList.add('text-warning');
                }

                // Send the status update request to the server
                fetch(`/expense/${expenseId}/status`, {
                        method: 'PUT',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                .getAttribute('content')
                        },
                        body: JSON.stringify({
                            status: newStatus
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            alert('Status updated successfully!');

                        } else {
                            alert('Failed to update status. Please try again.');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('An error occurred. Please try again.');
                    });
            });
        });



        // Edit Expense
        document.querySelectorAll('.edit-btn').forEach(button => {
            button.addEventListener('click', function() {
                const data = this.dataset;


                // Populate form fields
                document.getElementById('edit-expense-id').value = data.id;
                document.getElementById('edit-category').value = data.category;
                document.getElementById('edit-user').value = data.user;
                document.getElementById('edit-budget').value = data.budget;
                document.getElementById('edit-balance').value = data.balance;
                document.getElementById('edit-description').value = data.description;
                document.getElementById('edit-attachment').value = data.attachment;
                document.getElementById('edit-status').value = data.status;
                document.getElementById('edit-assign').value = data.assign;
                document.getElementById('edit-date').value = data
                    .date;

                // Open the modal
                new bootstrap.Modal(document.getElementById('editExpenseModal')).show();
            });
        });


        document.getElementById('editExpenseForm').addEventListener('submit', function(e) {
            const id = document.getElementById('edit-expense-id').value;

            fetch(`/expense/${id}`, {
                    method: 'PUT', // Correct method
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        categories_id: document.getElementById('edit-category').value,
                        user_id: document.getElementById('edit-user').value,
                        budget: document.getElementById('edit-budget').value,
                        budget_balance: document.getElementById('edit-balance').value,
                        description: document.getElementById('edit-description').value,
                        attachment: document.getElementById('edit-attachment').value,
                        status: document.getElementById('edit-status').value,
                        assign: document.getElementById('edit-assign').value,
                        date: document.getElementById('edit-date').value
                    })
                }).then(response => response.json())
                .then(data => {
                    console.log(data);
                    location.reload();
                })
                .catch(error => console.error('Error:', error));

        });


        document.querySelectorAll('.delete-btn').forEach(button => {
            button.addEventListener('click', function() {
                deleteId = this.dataset.id;
                new bootstrap.Modal(document.getElementById('deleteModal')).show();
            });
        });

        document.getElementById('confirmDeleteBtn').addEventListener('click', function() {
            fetch(`/expense/${deleteId}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        document.getElementById(`expense-row-${deleteId}`).remove();
                        bootstrap.Modal.getInstance(document.getElementById('deleteModal')).hide();
                    } else {
                        alert('Error deleting expense');
                    }
                });
        });
    </script>
@endpush
