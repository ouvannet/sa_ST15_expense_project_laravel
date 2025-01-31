@extends('layouts.app')
@section('title', 'Expenses')
@section('content')

    <!-- Expenses Table -->
    <div id="expensesTable" class="mb-5">
        <div class="card">
            <div class="card-body">
                <h5 class="mb-3 fw-bold">Recurring Expense</h5>
                <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addRecurringModal"
                    id="btn_add_recurring">
                    Create Recurring
                </button>

                <table class="table table-striped mb-0">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Expense ID</th>
                            <th scope="col">Amount</th>
                            <th scope="col">Frequency</th>
                            <th scope="col">Start Date</th>
                            <th scope="col">End Date</th>
                            <th scope="col">Next Date</th>
                            <th scope="col">Actions</th>

                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($recurring_expense as $recurring)
                            <tr id="recurring-row-{{ $recurring->id }}">
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $recurring->expense_id ?? 'N/A' }}</td>

                                <td>{{ $recurring->amount ?? 'N/A' }}</td>
                                <td>{{ $recurring->frequency ?? 'N/A' }}</td>
                                <td>{{ $recurring->start_date ?? 'N/A' }}</td>
                                <td>{{ $recurring->end_date ?? 'N/A' }}</td>
                                <td>{{ $recurring->next_run_date ?? 'N/A' }}</td>
                                <td class="d-flex justify-content-end gap-2">
                                    <button class="btn btn-sm btn-warning edit-btn">
                                        Edit
                                    </button>
                                    <button class="btn btn-sm btn-danger delete-btn">
                                        Delete
                                    </button>
                                </td>

                            </tr>
                        @empty
                            <tr>
                                <td colspan="11" class="text-center">No Recurring Expense</td>
                            </tr>
                        @endforelse


                    </tbody>
                </table>
            </div>
        </div>
    </div>


    @include('recurring.action.add')
    @include('recurring.action.edit')


@endsection



@push('js')
    <script>
        function reloadPage() {
            setTimeout(function() {
                location.reload();
            }, 1000);
        }


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

        // document.getElementById('btn_submit_recurring').addEventListener('click', function(e) {
        //     e.preventDefault();

        //     // Collect form data
        //     let formData = {
        //         _token: $('meta[name="csrf-token"]').attr('content'), // CSRF Token
        //         category_id: $('#category_id').val(),
        //         amount: $('#amount').val(),
        //         frequency: $('#frequency').val(),
        //         start_date: $('#start_date').val(),
        //         end_date: $('#end_date').val(),
        //         status: $('#status').val(),
        //     };
        //     const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        //     // Send data to backend using Fetch API
        //     fetch('/recurring_submit_add', {
        //             method: 'POST',
        //             headers: {
        //                 'X-CSRF-TOKEN': csrfToken,
        //                 'Content-Type': 'application/json',
        //             },
        //             body: JSON.stringify(formData)
        //         })
        //         .then(response => response.json())
        //         .then(data => {
        //             if (data.success) {
        //                 location.reload(); // Reload page to update table
        //             } else {
        //                 alert('Error: ' + data.message);
        //             }
        //         })
        //         .catch(error => {
        //             console.error('Error:', error);
        //         });
        // });




        function edit_category(category_id) {
            console.log(category_id);
            $.ajax({
                url: `/category/${category_id}/edit`,
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


        $(document).on('click', "#btn_submit_edit_category", function() {
            const formData = $("#addCategoryForm").serializeArray();

            console.table(formData);
            $.ajax({
                url: "/category",
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

        function delete_category(category_id) {
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
                        url: "/category/" + category_id,
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
