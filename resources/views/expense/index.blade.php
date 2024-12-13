{{-- @extends('layouts.app')

@section('title', 'Expense')

@section('content')
    <div id="ExpensesTable" class="mb-5">
        <div class="card">
            <div class="card-body">
                <h5 class="mb-3 fw-bold">Expenses List</h5>
                <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addExpenseModal">
                    Add Expense
                </button>

                <table class="table table-striped mb-0">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Categories id</th>
                            <th scope="col">User id</th>
                            <th scope="col">Budget</th>
                            <th scope="col">Budget Balance</th>
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
                                <td>{{ $expense->categories_id }}</td>
                                <td>{{ $expense->user_id }}</td>
                                <td>{{ $expense->budget }}</td>
                                <td>{{ $expense->budget_balance }}</td>
                                <td>{{ $expense->description }}</td>
                                <td>{{ $expense->attachment }}</td>
                                <td>{{ $expense->status }}</td>
                                <td>{{ $expense->assign }}</td>
                                <td>{{ \Carbon\Carbon::parse($expense->date)->format('Y-m-d') }}</td>

                                <td>
                                    <button class="btn btn-sm btn-warning edit-btn" data-id="{{ $expense->id }}"
                                        data-categories_id="{{ $expense->categories_id }}"
                                        data-user_id="{{ $expense->user_id }}" data-budget="{{ $expense->budget }}"
                                        data-budget_balance="{{ $expense->budget_balance }}"
                                        data-description="{{ $expense->description }}"
                                        data-status="{{ $expense->status }}" data-assign="{{ $expense->assign }}"
                                        data-date="{{ $expense->date }}" data-bs-toggle="modal"
                                        data-bs-target="#expenseModal">
                                        Edit
                                    </button>
                                    <button class="btn btn-sm btn-danger delete-btn"
                                        data-id="{{ $expense->id }}">Delete</button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center">No expense.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <!-- Expense Modal -->
    <div class="modal fade" id="addExpenseModal" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLabel">Add Expense</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="expenseForm">
                        @csrf
                        <input type="hidden" id="expense_id">
                        <div class="mb-3">
                            <label>Category ID</label>
                            <input type="number" id="categories_id" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label>User ID</label>
                            <input type="number" id="user_id" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label>Budget</label>
                            <input type="number" id="budget" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label>Budget Balance</label>
                            <input type="number" id="budget_balance" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label>Description</label>
                            <input type="text" id="description" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label>Status</label>
                            <input type="text" id="status" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label>Assign</label>
                            <input type="text" id="assign" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label>Date</label>
                            <input type="date" id="date" class="form-control">
                        </div>
                        <button type="button" id="saveExpenseBtn" class="btn btn-primary">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

<!-- JavaScript -->
@push('scripts')
    <script>
        $(document).ready(function() {
            // Open modal for adding or editing
            $('.edit-btn').on('click', function() {
                $('#modalLabel').text('Edit Expense');
                $('#expense_id').val($(this).data('id'));
                $('#categories_id').val($(this).data('categories_id'));
                $('#user_id').val($(this).data('user_id'));
                $('#budget').val($(this).data('budget'));
                $('#budget_balance').val($(this).data('budget_balance'));
                $('#description').val($(this).data('description'));
                $('#status').val($(this).data('status'));
                $('#assign').val($(this).data('assign'));
                $('#date').val($(this).data('date'));
            });

            $('#saveExpenseBtn').on('click', function() {
                let id = $('#expense_id').val();
                let url = id ? `/expenses/${id}` : '/expenses';
                let method = id ? 'PUT' : 'POST';

                $.ajax({
                    url: url,
                    method: method,
                    data: {
                        _token: '{{ csrf_token() }}',
                        categories_id: $('#categories_id').val(),
                        user_id: $('#user_id').val(),
                        budget: $('#budget').val(),
                        budget_balance: $('#budget_balance').val(),
                        description: $('#description').val(),
                        status: $('#status').val(),
                        assign: $('#assign').val(),
                        date: $('#date').val()
                    },
                    success: function(res) {
                        location.reload();
                    }
                });
            });

            $('.delete-btn').on('click', function() {
                let id = $(this).data('id');
                if (confirm('Are you sure to delete this expense?')) {
                    $.ajax({
                        url: `/expenses/${id}`,
                        method: 'DELETE',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function() {
                            location.reload();
                        }
                    });
                }
            });
        });
    </script>
@endpush
 --}}




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
                            <th scope="col">#</th>
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
                                <td>{{ $expense->categories_id }}</td>
                                <td>{{ $expense->user_id }}</td>
                                <td>{{ $expense->budget }}</td>
                                <td>{{ $expense->budget_balance }}</td>

                                <td>{{ $expense->description }}</td>
                                <td>{{ $expense->attachment }}</td>
                                <td>{{ $expense->status }}</td>
                                <td>{{ $expense->assign }}</td>

                                <td>{{ \Carbon\Carbon::parse($expense->date)->format('Y-m-d') }}</td>
                                <td class="d-flex justify-content-end gap-2">
                                    <!-- Edit Button -->
                                    <button class="btn btn-sm btn-warning edit-btn" data-id="{{ $expense->id }}"
                                        data-category="{{ $expense->categories_id }}" data-user="{{ $expense->user_id }}"
                                        data-budget="{{ $expense->budget }}" data-balance="{{ $expense->budget_balance }}"
                                        data-description="{{$expense->description}}" data-attachment="{{$expense->attachment}}"
                                        data-status="{{$expense->status}}" data-assign="{{$expense->assign}}"
                                        data-date="{{ \Illuminate\Support\Str::before($expense->date, ' ') }}">
                                        Edit
                                    </button>


                                    <!-- Delete Button -->
                                    <button class="btn btn-sm btn-danger delete-btn" data-id="{{ $expense->id }}">
                                        Delete
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">No expenses available.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>




    <!-- Add Expense Modal -->
    <div class="modal fade" id="addExpenseModal" tabindex="-1" aria-labelledby="addExpenseLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addExpenseLabel">Add Expense</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addExpenseForm">
                        <div class="mb-3">
                            <label for="category" class="form-label">Category</label>
                            <input type="text" class="form-control" id="category" required>
                        </div>
                        <div class="mb-3">
                            <label for="user" class="form-label">User</label>
                            <input type="text" class="form-control" id="user" required>
                        </div>
                        <div class="mb-3">
                            <label for="budget" class="form-label">Budget</label>
                            <input type="number" class="form-control" id="budget" required>
                        </div>
                        <div class="mb-3">
                            <label for="balance" class="form-label">Balance</label>
                            <input type="number" class="form-control" id="balance" required>
                        </div>
                        <div class="mb-3">
                            <label for="date" class="form-label">Date</label>
                            <input type="date" class="form-control" id="date" required>
                        </div>
                        <button type="submit" class="btn btn-success">Add Expense</button>
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
                        <input type="hidden" id="edit-expense-id">
                        <div class="mb-3">
                            <label for="edit-category" class="form-label">Category</label>
                            <input type="text" class="form-control" id="edit-category" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit-user" class="form-label">User</label>
                            <input type="text" class="form-control" id="edit-user" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit-budget" class="form-label">Budget</label>
                            <input type="number" class="form-control" id="edit-budget" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit-balance" class="form-label">Budget Balance</label>
                            <input type="number" class="form-control" id="edit-balance" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit-description" class="form-label">Description</label>
                            <input type="text" class="form-control" id="edit-description" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit-attachment" class="form-label">Attachment</label>
                            <input type="text" class="form-control" id="edit-attachment" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit-status" class="form-label">Status</label>
                            <input type="text" class="form-control" id="edit-status" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit-assign" class="form-label">Assign To</label>
                            <input type="number" class="form-control" id="edit-assign" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit-date" class="form-label">Date</label>
                            <input type="date" class="form-control" id="edit-date" required>
                        </div>
                        <button type="submit" class="btn btn-success">Update Expense</button>
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
        let deleteId = null;

        // Add Expense
        document.getElementById('addExpenseForm').addEventListener('submit', function(e) {
            e.preventDefault();

            const formData = {
                categories_id: document.getElementById('category').value,
                user_id: document.getElementById('user').value,
                budget: document.getElementById('budget').value,
                budget_balance: document.getElementById('balance').value,


                date: document.getElementById('date').value
            };

            fetch('/expense', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(formData)
            }).then(response => response.json()).then(() => location.reload());
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
                


                document.getElementById('edit-date').value = data.date; // Make sure this matches 'data-date'

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
                        alert('Error deleting category');
                    }
                });
        });
    </script>
@endpush
