@extends('layouts.app')

@section('title', 'Expense')

@push('js')
    <script src="/assets/plugins/apexcharts/dist/apexcharts.min.js"></script>
    <script src="/assets/js/demo/dashboard.demo.js"></script>
@endpush

@section('content')
    <!-- Expenses Table -->
    <div id="userTable" class="mb-5">
        <div class="card">
            <div class="card-body">
                <h5 class="mb-3 fw-bold">User List</h5>
                @if (user_permission('Add_User'))
                    <button type="button" class="btn btn-primary mb-3" id="btn_add_user">
                        Add User
                    </button>
                @endif
                <table class="table table-striped mb-0">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Gender</th>
                            <th scope="col">Dob</th>
                            <th scope="col">Email</th>
                            <th scope="col">Phone</th>
                            <th scope="col">Department</th>
                            <th scope="col">Role</th>
                            <th scope="col" class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->name ?? '' }}</td>
                                <td>{{ $user->gender ?? '' }}</td>
                                <td>{{ $user->dob ?? '' }}</td>
                                <td>{{ $user->email ?? '' }}</td>
                                <td>{{ $user->phone ?? '' }}</td>
                                <td>{{ $user->department->name ?? '' }}</td>
                                <td>{{ $user->role->name ?? '' }}</td>
                                <td class="d-flex justify-content-end gap-2">

                                    @if (user_permission('Edit_User'))
                                        <button onclick="edit_user({{ $user->id }})"
                                            class="btn btn-sm btn-warning edit-btn">
                                            Edit
                                        </button>
                                    @endif

                                    @if (user_permission('Delete_User'))
                                        <button onclick="delete_user({{ $user->id }})"
                                            class="btn btn-sm btn-danger delete-btn">
                                            Delete
                                        </button>
                                    @endif
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

@endsection

@push('js')
    <script>
        function reloadPage() {
            setTimeout(function() {
                location.reload();
            }, 1000);
        }
        $("#btn_add_user").click(function() {
            $.ajax({
                url: "{{ route('user.add') }}",
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
        })
        $(document).on('click', "#btn_submit_add_user", function() {
            const formData = $("#adduserForm").serializeArray();
            console.table(formData);
            $.ajax({
                url: "{{ route('user.submit_add') }}",
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

        function edit_user(user_id) {
            console.log(user_id);
            $.ajax({
                url: `/user/${user_id}/edit`,
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

        $(document).on('click', "#btn_submit_edit_user", function() {
            const formData = $("#adduserForm").serializeArray();
            console.table(formData);
            $.ajax({
                url: "/user",
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

        function delete_user(user_id) {
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
                        url: "/user/" + user_id,
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
