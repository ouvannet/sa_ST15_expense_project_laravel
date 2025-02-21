@extends('layouts.app')
@section('title', 'Expenses')
@section('content')

    
    <!-- Expenses Table -->
    <div id="expensesTable" class="mb-5">
        <div class="card">
            <div class="card-body">
                <h5 class="mb-3 fw-bold">Expenses List</h5>
                <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal"
                    data-bs-target="#addExpenseModal">
                    Add Expense
                </button>

                <table class="table table-striped mb-0">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Reference</th>
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
                                <td>
                                    <a class="text-decoration-none btn btn-sm btn-primary"
                                        href="{{ route('expense.show', ['id' => $expense->id]) }}">
                                        {{ $expense->reference_number }}
                                    </a>
                                </td>
                                <td>{{ $expense->category->name ?? 'N/A' }}</td>
                                <td>{{ $expense->requester->name ?? 'N/A' }}</td> <!-- User who requested -->
                                <td>{{ $expense->budget }}</td>
                                <td>{{ $expense->budget_balance }}</td>
                                <td>{{ $expense->description }}</td>
                                <td>
                                    <a href="{{ $expense->attachment }}" class="btn btn-sm btn-light">
                                        <img src="/images/icon/attachment.png" width="15px">
                                    </a>
                                </td>
                                <td>
                                    @if ($expense->status == 'Completed')
                                        <span class="text-primary ">Completed</span>
                                    @else
                                        <select
                                            class="form-select update-status-select {{ $expense->status == 'Approved' ? 'text-success' : ($expense->status == 'Canceled' ? 'text-danger' : 'text-warning') }}"
                                            data-expense-id="{{ $expense->id }}">
                                            <option value="Pending" {{ $expense->status == 'Pending' ? 'selected' : '' }}>
                                                Pending
                                            </option>
                                            <option value="Approved"
                                                {{ $expense->status == 'Approved' ? 'selected' : '' }}>
                                                Approved
                                            </option>
                                            <option value="Canceled"
                                                {{ $expense->status == 'Canceled' ? 'selected' : '' }}>
                                                Canceled
                                            </option>
                                        </select>
                                    @endif
                                </td>
                                <td>{{ $expense->approver->name ?? 'N/A' }}</td> <!-- User who approves -->
                                <td>{{ \Carbon\Carbon::parse($expense->date)->format('Y-m-d') }}</td>
                                <td class="d-flex justify-content-end gap-2">
                                    <button class="btn btn-sm btn-warning edit-btn py-2" data-id="{{ $expense->id }}"
                                        data-reference_number="{{ $expense->reference_number }}"
                                        data-category="{{ $expense->categories_id }}" data-user="{{ $expense->user_id }}"
                                        data-budget="{{ $expense->budget }}" data-balance="{{ $expense->budget_balance }}"
                                        data-description="{{ $expense->description }}"
                                        data-attachment="{{ $expense->attachment }}" data-status="{{ $expense->status }}"
                                        data-assign="{{ $expense->assign }}"
                                        data-date="{{ \Illuminate\Support\Str::before($expense->date, ' ') }}">
                                        Edit
                                    </button>
                                    <button onclick="delete_expense({{ $expense->id }})" class="btn btn-sm btn-danger"
                                        data-id="{{ $expense->id }}">
                                        Delete
                                    </button>
                                    <button class="btn btn-sm btn-info preview-btn" data-id="{{ $expense->id }}"
                                        data-bs-toggle="modal" data-bs-target="#invoiceModal">
                                        Preview
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

    < <div class="modal fade" id="invoiceModal" tabindex="-1" aria-labelledby="invoiceModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold" id="invoiceModalLabel">Invoice Preview</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="invoiceContent">
                    <!-- Invoice content will be dynamically loaded here -->
                    <p class="text-center text-muted">Loading...</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary print-btn">Print</button>
                </div>
            </div>
        </div>
        </div>


        @include('expense.action.add')
        @include('expense.action.edit') 

    @endsection 




    @push('js')
        <script>
            function reloadPage() {
                setTimeout(function() {
                    location.reload();
                }, 1000);
            }
            let deleteId = null;


            $(document).ready(function() {

                $('.preview-btn').on('click', function() {
                    const id = $(this).data('id');


                    $.ajax({
                        url: `/expense/preview/${id}`,
                        method: 'GET',

                        beforeSend: function() {
                            $('#invoiceContent').html(
                                '<p class="text-center text-muted">Loading...</p>'
                            );
                        },
                        success: function(response) {
                            if (response.html) {

                                $('#invoiceContent').html(response.html);
                            } else if (response.error) {
                                $('#invoiceContent').html(
                                    `<p class="text-center text-danger">${response.error}</p>`
                                );
                            }
                        },
                        error: function() {
                            $('#invoiceContent').html(
                                '<p class="text-center text-danger">Failed to load the invoice. Please try again later.</p>'
                            );
                        },
                    });
                });
            });


            // Handle the "Print" button click
            $('.print-btn').on('click', function() {
                const content = $('#invoiceContent').html();

                // Open a new print window
                const printWindow = window.open('', '_blank');
                printWindow.document.write(`
                <html>
                    <head>
                        <title>Invoice</title>
                        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
                    </head>
                    <body onload="window.print(); window.close();">
                        ${content}
                    </body>
                </html>
            `);
                printWindow.document.close();
            });


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
                    //document.getElementById('edit-balance').value = data.balance;
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
                            budget_balance: document.getElementById('edit-budget').value,
                            description: document.getElementById('edit-description').value,
                            attachment: document.getElementById('edit-attachment').value,
                            status: document.getElementById('edit-status').value,
                            assign: document.getElementById('edit-assign').value,
                            date: document.getElementById('edit-date').value
                        })
                    }).then(response => response.json())
                    .then(data => {
                        console.log(data);
                        //location.reload();
                    })
                    .catch(error => console.error('Error:', error));

            });




            function delete_expense(expense_id) {
                Swal.fire({
                    title: "Are you sure?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, delete it!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "/expense/" + expense_id,
                            type: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function(response) {
                                console.log(response);
                                if (response.status == 1) {
                                    Swal.fire({
                                        title: "Deleted!",
                                        text: response.message,
                                        icon: "success"
                                    });
                                    reloadPage();
                                }
                            },
                            error: function(xhr) {
                                console.log(xhr);

                            }
                        });
                    }
                });
            }
        </script>
    @endpush
