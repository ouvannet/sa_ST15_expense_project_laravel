@extends('layouts.app')

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
