@extends('layouts.app')
@section('title', 'Expenses')
@section('content')

    <!-- Expenses Table -->
    <div id="expensesTable" class="mb-5">
        <div class="card">
            <div class="card-body">
                <h5 class="mb-3 fw-bold">Recurring Expense</h5>
                <button type="button" class="btn btn-primary mb-3" id="btn_add_recurring">
                    Create Recurring
                </button>

                <table class="table table-striped mb-0">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Category</th>
                            <th scope="col">Amount</th>
                            <th scope="col">Frequency</th>
                            <th scope="col">Start Date</th>
                            <th scope="col">End Date</th>
                            <th scope="col">Next Date</th>
                            <th scope="col">Status</th>
                            <th scope="col">Actions</th>

                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($recurring_expense as $recurring)
                            <tr id="recurring-row-{{ $recurring->id }}">
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $recurring->category->name ?? 'N/A' }}</td>

                                <td>{{ $recurring->amount ?? 'N/A' }}</td>
                                <td>{{ $recurring->frequency ?? 'N/A' }}</td>
                                <td>{{ $recurring->start_date ?? 'N/A' }}</td>
                                <td>{{ $recurring->end_date ?? 'N/A' }}</td>
                                <td>{{ $recurring->next_run_date ?? 'N/A' }}</td>
                                <td class=" {{ $recurring->status == 'active' ? 'text-success' : ($recurring->status =='inactive' ? 'text-warning' : 'text-danger') }} ">
                                    {{ $recurring->status ?? 'N/A' }}</td>

                                <td class="d-flex justify-content-end gap-2">
                                    <button onclick="edit_recurring({{ $recurring->id }})"
                                        class="btn btn-sm btn-warning edit-btn">
                                        Edit
                                    </button>
                                    <button onclick="delete_recurring({{ $recurring->id }})"
                                        class="btn btn-sm btn-danger delete-btn">
                                        Delete
                                    </button>
                                </td>

                            </tr>
                        @empty
                            <tr>
                                <td colspan="11" class="text-center">No Recurring Expense is there</td>
                            </tr>
                        @endforelse


                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection


{{-- 
@push('js')
    <script>
        function reloadPage() {
            setTimeout(function() {
                location.reload();
            }, 1000);
        }


        $("#searchExpense").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $(".expense-item").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
            });
        });

        $(".expense-item").on("click", function() {
            var expenseId = $(this).data("id");
            var expenseName = $(this).data("name");
            var expenseAmount = $(this).data("amount");

            $("#expense_id").val(expenseId);
            $("#selectedExpenseText").text(expenseName + " - $" + expenseAmount);
        });



        $("#btn_add_recurring").click(function() {
            $.ajax({
                url: "{{ route('Recurring.add') }}",
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

        $(document).on('click', "#btn_submit_recurring", function() {
            const formData = $("#addRecurringForm").serializeArray();
            console.table(formData);
            $.ajax({
                url: "{{ route('recurring.submit_add') }}",
                type: 'POST',
                data: formData,
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
                    console.log(xhr);

                }
            });
        })


        function edit_recurring(recurring_id) {
            console.log(recurring_id);
            $.ajax({
                url: `/recurring/${recurring_id}/edit`,
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


        $(document).on('click', "#btn_submit_edit_recurring", function() {
            const formData = $("#addRecurringForm").serializeArray();

            console.table(formData);
            $.ajax({
                url: "/recurring",
                type: 'PUT',
                data: formData,
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
                    console.log(xhr);

                }
            });
        })

        function delete_recurring(recurring_id) {
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
                        url: "/recurring/" + recurring_id,
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
@endpush --}}

@push('js')
    <script>
        function reloadPage() {
            setTimeout(function() {
                location.reload();
            }, 1000);
        }

        $("#searchExpense").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $(".expense-item").filter(function() {
                $(this).toggle($(this).text().toLowerCase().includes(value));
            });
        });

       // Dynamically handle expense selection
       $(document).on("click", ".expense-item", function() {
            var expenseId = $(this).data("id");
            var expenseAmount = $(this).data("amount");
            var categoryId = $(this).data("category-id");

            // Populate hidden fields
            $("#expense_id").val(expenseId);
            $("#selectedExpenseText").text(`Expense ID: ${expenseId} | Amount: $${expenseAmount}`);

            // Insert values into respective form fields
            $("#category_id").val(categoryId); // Ensure this field is in the form
            $("#amount").val(expenseAmount);   // Ensure this field is in the form
        });

        // Load add recurring expense modal
        $("#btn_add_recurring").click(function() {
            $.ajax({
                url: "{{ route('Recurring.add') }}",  // Ensure this route is defined
                type: 'GET',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    $("#globalModalView").html(response);
                    $("#globalModalView").modal('toggle');
                },
                error: function(xhr) {
                    console.log(xhr);
                }
            });
        });

        // Submit Add Recurring form
        $(document).on('click', "#btn_submit_recurring", function() {
            const formData = $("#addRecurringForm").serializeArray();
            $.ajax({
                url: "{{ route('recurring.submit_add') }}",  // Ensure this route is defined
                type: 'POST',
                data: formData,
                success: function(response) {
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
                    console.log(xhr);
                }
            });
        });

        // Edit Recurring Expense
        function edit_recurring(recurring_id) {
            $.ajax({
                url: `/recurring/${recurring_id}/edit`,
                type: 'GET',
                success: function(response) {
                    $("#globalModalView").html(response);
                    $("#globalModalView").modal('toggle');
                },
                error: function(xhr) {
                    console.log(xhr);
                }
            });
        }

        // Submit Edit Recurring Form
        $(document).on('click', "#btn_submit_edit_recurring", function() {
            const formData = $("#addRecurringForm").serializeArray();
            $.ajax({
                url: "/recurring",
                type: 'PUT',
                data: formData,
                success: function(response) {
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
                    console.log(xhr);
                }
            });
        });

        // Delete Recurring Expense
        function delete_recurring(recurring_id) {
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
                        url: "/recurring/" + recurring_id,
                        type: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
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
