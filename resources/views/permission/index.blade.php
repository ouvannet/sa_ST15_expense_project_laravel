@extends('layouts.app')

@section('title', 'Expense')

@push('js')
    <script src="/assets/plugins/apexcharts/dist/apexcharts.min.js"></script>
    <script src="/assets/js/demo/dashboard.demo.js"></script>
@endpush


@section('content')
    <!-- Expenses Table -->
    <div id="permissionTable" class="mb-5">
        <div class="card">
            <div class="card-body">
                <h5 class="mb-3 fw-bold">Permission List</h5>

                @if (user_permission('Add_Permission'))
                    <button type="button" class="btn btn-primary mb-3" id="btn_add_permission">
                        Add Permission
                    </button>
                @endif
                <table class="table table-striped mb-0">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col" class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($permission as $per)
                            <tr>
                                <td>{{ $per->id }}</td>
                                <td>{{ $per->name }}</td>
                                <td class="gap-2 text-end">

                                    @if (user_permission('Edit_Permission'))
                                    <button onclick="edit_permission({{ $per->id }})"
                                        class="btn btn-sm btn-warning edit-btn">
                                        Edit
                                    </button>
                                    @endif

                                    @if (user_permission('Delete_Permission'))
                                    <button onclick="delete_permission({{ $per->id }})"
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


        $("#btn_add_permission").click(function() {
            $.ajax({
                url: "{{ route('permission.add') }}",
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



        $(document).on('click', "#btn_submit_add_permission", function() {
            const formData = $("#addpermissionForm").serializeArray();
            console.table(formData);
            $.ajax({
                url: "{{ route('permission.submit_add') }}",
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

        function edit_permission(permission_id) {
            console.log(permission_id);
            $.ajax({
                url: `/permission/${permission_id}/edit`,
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

        $(document).on('click', "#btn_submit_edit_permission", function() {
            const formData = $("#addpermissionForm").serializeArray();
            console.table(formData);
            $.ajax({
                url: "/permission",
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


        function delete_permission(permission_id) {
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
                        url: "/permission/" + permission_id,
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
