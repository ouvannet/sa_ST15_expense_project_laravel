@extends('layouts.app')
@section('title', 'Expenses')
@section('content')

    <!-- Expenses Table -->
    <div id="expensesTable" class="mb-5">
        <div class="card">
            <div class="card-body">
                <h5 class="mb-3 fw-bold">Recurring Expense</h5>
                <button type="button" class="btn btn-primary mb-3" 
                    id="btn_add_recurring">
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
                                <td class=" {{$recurring->status == 'active' ? 'text-success' : 'text-danger'}} " >{{ $recurring->status ?? 'N/A' }}</td>

                                <td class="d-flex justify-content-end gap-2">
                                    <button onclick="edit_recurring({{$recurring->id}})"  class="btn btn-sm btn-warning edit-btn">
                                        Edit
                                    </button>
                                    <button onclick="delete_recurring({{$recurring->id}})" class="btn btn-sm btn-danger delete-btn">
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


    {{-- @include('recurring.action.add') --}}
    {{-- @include('recurring.action.edit') --}}


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
@endpush
