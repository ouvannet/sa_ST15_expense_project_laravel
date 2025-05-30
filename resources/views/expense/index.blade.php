@extends('layouts.app')
@section('title', 'Expenses')
@section('content')


<!-- Expenses Table -->
<div id="expensesTable" class="mb-5">
    <div class="card">
        <div class="card-body">
            <h5 class="mb-3 fw-bold">Expenses List</h5>

            @if (user_permission('Add_Expense'))
            <button type="button" class="btn btn-primary mb-3" id="btn_add_exp" data-bs-toggle="modal"
                data-bs-target="#addExpenseModal">
                Add Expense
            </button>
            @endif

            <table id="expensesDataTable" class="table table-striped mb-0">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Reference</th>
                        <th scope="col">Category</th>
                        <th scope="col">User</th>
                        <th scope="col">Budget</th>
                        <th scope="col">Balance</th>
                        <th scope="col">Attachment</th>
                        <th scope="col">Status</th>
                        <th scope="col">Assign To</th>
                        <th scope="col">Date</th>
                        <th scope="col" class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($expenses as $expense)
                    <tr id="expense-row-{{ $expense->id }}">
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            @if ($expense->status == 'Approved' || $expense->status == 'Completed')
                            <a class="text-decoration-none btn btn-sm btn-primary"
                                href="{{ route('expense.show', ['id' => $expense->id]) }}">
                                {{ $expense->reference_number }}
                            </a>
                            @else
                            <span class="text-muted">{{ $expense->reference_number }}</span>
                            @endif
                            @if ($expense->recurringExpense)
                            <span class="badge bg-info ms-2">Recurring</span>
                            @endif
                        </td>
                        <td>{{ $expense->category->name ?? 'N/A' }}</td>
                        <td>{{ $expense->requester->name ?? 'N/A' }}</td>
                        <td>{{ $expense->budget }}</td>
                        <td>{{ $expense->budget_balance }}</td>

                        <td>
                            @if ($expense->attachment)
                            @php
                            $fileExtension = pathinfo($expense->attachment, PATHINFO_EXTENSION);
                            @endphp
                            @if (in_array($fileExtension, ['png', 'jpg', 'jpeg', 'gif', 'webp']))
                            <a href="{{ asset('storage/' . $expense->attachment) }}" target="_blank">
                                <img src="{{ asset('storage/' . $expense->attachment) }}" width="50"
                                    height="50" class="rounded shadow">
                            </a>
                            @elseif ($fileExtension === 'pdf')
                            <a href="{{ asset('storage/' . $expense->attachment) }}" target="_blank">
                                <i class="fas fa-file-pdf text-danger" style="font-size: 24px;"></i>
                            </a>
                            @else
                            <a href="{{ asset('storage/' . $expense->attachment) }}" target="_blank"
                                class="btn btn-sm btn-light">
                                <i class="fas fa-download"></i> Download
                            </a>
                            @endif
                            @else
                            <span class="text-muted">No attachment</span>
                            @endif
                        </td>
                        <td>
                            @if ($expense->status == 'Completed')
                            <span class="text-primary">Completed</span>
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
                        <td>{{ $expense->approver->name ?? 'N/A' }}</td>
                        <td>{{ \Carbon\Carbon::parse($expense->date)->format('Y-m-d') }}</td>


                        <td class="text-center">
                            <div class="btn-group">
                                <button class="btn btn-sm btn-secondary dropdown-toggle" type="button"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    Actions
                                </button>
                                <!-- {{-- {{ auth()->user()->role }} --}} -->

                                <ul class="dropdown-menu">
                                    @if (user_permission('Edit_Expense'))
                                    <li>
                                        <button class="dropdown-item text-warning"
                                            onclick="edit_expense({{ $expense->id }})">
                                            ✏️ Edit
                                        </button>
                                    </li>
                                    @endif

                                    @if (user_permission('Delete_Expense'))
                                    <li>
                                        <button class="dropdown-item text-danger"
                                            onclick="delete_expense({{ $expense->id }})">
                                            🗑️ Delete
                                        </button>
                                    </li>
                                    @endif

                                    <li>
                                        <button class="dropdown-item text-info preview-btn"
                                            data-id="{{ $expense->id }}" data-bs-toggle="modal"
                                            data-bs-target="#invoiceModal">
                                            🖨️ Preview
                                        </button>
                                    </li>
                                </ul>
                            </div>
                        </td>


                    </tr>
                    @empty
                    <tr>
                        <td colspan="12" class="text-center">No expenses available.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>





<div class="modal fade" id="invoiceModal" tabindex="-1" aria-labelledby="invoiceModalLabel" aria-hidden="true">
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


@endsection




@push('js')
<script>
    function reloadPage() {
        setTimeout(function() {
            location.reload();
        }, 1000);
    }



    //let deleteId = null;
    $(document).ready(function() {
        $('#expensesDataTable').DataTable({
            responsive: true, // Makes table responsive
            lengthMenu: [
                [5, 10, 20, 50, -1],
                [5, 10, 20, 50, "All"]
            ],
            pageLength: 10,
            pagingType: "full_numbers",
            dom: '<"row"<"col-md-6"l><"col-md-6"f>>rt<"row"<"col-md-6"i><"col-md-6"p>>',
            language: {
                lengthMenu: "Show _MENU_ entries",
                info: "Showing _START_ to _END_ of _TOTAL_ entries",
                infoEmpty: "No records available",
                infoFiltered: "(filtered from _MAX_ total entries)",
                search: "Search:",
                paginate: {
                    first: "First",
                    last: "Last",
                    next: "Next",
                    previous: "Previous"
                }
            }
        });
    });



    $("#btn_add_exp").click(function() {
        $.ajax({
            url: "{{ route('Expense.add') }}",
            type: 'GET',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                console.log(response);
                $("#globalModalView").html(response);
                $("#globalModalView").modal('toggle');
            },
            error: function(xhr) {
                console.log(xhr);
            }
        });
    })



    $(document).on('click', "#btn_submit_expense", function() {
        const form = document.getElementById('addExpenseForm');
        const formData = new FormData(form);

        // Reset any previous validation states
        $('#form-errors').addClass('d-none').text('');
        form.querySelectorAll('.is-invalid').forEach(el => el.classList.remove('is-invalid'));

        // Client-side validation
        let isValid = true;
        form.querySelectorAll('[required]').forEach(field => {
            if (!field.value.trim()) { // Check if field is empty
                field.classList.add('is-invalid');
                isValid = false;
            }
        });

        if (!isValid) {
            $('#form-errors').removeClass('d-none').text('Please fill out all required fields.');
            return; // Stop submission if validation fails
        }

        $.ajax({
            url: "{{ route('Expense.submit_add') }}",
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                if (response.status == 1) {
                    $("#globalModalView").modal(
                        'toggle'); // Adjust modal ID if different
                    Swal.fire({
                        title: response.message,
                        icon: "success",
                        draggable: true
                    });
                    reloadPage();
                }
            },
            error: function(xhr) {
                console.log(xhr.responseJSON);
                if (xhr.responseJSON && xhr.responseJSON.errors) {
                    let errorMsg = 'Please fix the following errors:\n';
                    for (let field in xhr.responseJSON.errors) {
                        errorMsg += `- ${xhr.responseJSON.errors[field][0]}\n`;
                        $(`#${field}`).addClass(
                            'is-invalid'); // Highlight invalid fields
                    }
                    $('#form-errors').removeClass('d-none').text(errorMsg);
                } else {
                    Swal.fire({
                        title: 'Error',
                        text: 'Something went wrong!',
                        icon: 'error'
                    });
                }
            }
        });
    });

    function reloadPage() {
        location.reload(); // Or update table dynamically
    }



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





    document.querySelectorAll('.update-status-select').forEach(select => {
        select.addEventListener('change', function() {
            const expenseId = this.dataset
                .expenseId; // Assuming you have a `data-expense-id` attribute
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
                        'X-CSRF-TOKEN': document.querySelector(
                                'meta[name="csrf-token"]')
                            .getAttribute('content')
                    },
                    body: JSON.stringify({
                        status: newStatus
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        $("#globalModalView").modal('toggle');
                        Swal.fire({
                            title: data.message,
                            icon: "success",
                            draggable: true
                        });
                        reloadPage();
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

    function edit_expense(expense_id) {
        console.log(expense_id);
        $.ajax({
            url: `/expense/${expense_id}/edit`,
            type: 'GET',
            success: function(response) {
                console.log(response);
                $("#globalModalView").html(response);
                $("#globalModalView").modal('toggle');
            },
            error: function(xhr) {
                console.log(xhr);
            }
        });
    }

    $(document).on('click', "#btn_submit_edit_expense", function() {
        const formData = new FormData(document.getElementById('editExpenseForm'));
        // Add _method=PUT since Laravel expects this for updates via POST
        formData.append('_method', 'PUT');

        // Log form data for debugging (optional)
        for (let pair of formData.entries()) {
            console.log(pair[0] + ': ' + pair[1]);
        }

        $.ajax({
            url: "/expense", // Matches your controller route
            type: 'POST', // Use POST with _method=PUT for Laravel file uploads
            data: formData,
            processData: false, // Prevent jQuery from processing the data
            contentType: false, // Let browser set multipart/form-data
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                console.log(response);
                if (response.status == 1) {
                    $("#globalModalView").modal('toggle');
                    Swal.fire({
                        title: response.message,
                        icon: "success",
                        draggable: true
                    });
                    reloadPage();
                }
            },
            error: function(xhr) {
                console.log(xhr.responseJSON); // Log full error response
            }
        });
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