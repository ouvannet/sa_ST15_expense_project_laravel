@extends('layouts.app')

@section('title', 'Categories')

@section('content')
    <div id="departmentsTable" class="mb-5">
        <div class="card">
            <div class="card-body">
                <h5 class="mb-3 fw-bold">Departments List</h5>
                <button type="button" id="btn_add_department" class="btn btn-primary mb-3" data-bs-toggle="modal"
                    data-bs-target="#addDepartmentModal">
                    Add Department
                </button>

                <table class="table table-striped mb-0">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Description</th>
                            <th scope="col" class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($departments as $department)
                            <tr id="department-row-{{ $department->id }}">
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $department->name }}</td>
                                <td>{{ $department->description }}</td>
                                <td class="d-flex justify-content-end gap-2">
                                    <!-- Edit Button -->
                                    <button onclick="edit_department({{$department->id}})" class="btn btn-sm btn-warning edit-btn px-3" data-id="{{ $department->id }}"
                                        data-name="{{ $department->name }}"
                                        data-description="{{ $department->description }}">
                                        Edit
                                    </button>

                                    <!-- Delete Button -->
                                    <button onclick="delete_department({{$department->id}})" class="btn btn-sm btn-danger delete-btn px-3" data-id="{{ $department->id }}">
                                        Delete
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center">No categories available.</td>
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


        $("#btn_add_department").click(function() {
            $.ajax({
                url: "{{ route('department.add') }}",
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



        $(document).on('click', "#btn_add_submit_department", function() {
            const formData = $("#addDepartmentForm").serializeArray();
            console.table(formData);
            $.ajax({
                url: "{{ route('department.submit_add') }}",
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




        function edit_department(department_id) {
            $.ajax({
                url: `/department/${department_id}/edit`,
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


        $(document).on('click', "#btn_submit_edit_department", function() {
            const formData = $("#addDepartmentForm").serializeArray();

            console.table(formData);
            $.ajax({
                url: "/department",
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



        function delete_department(department_id) {
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
                        url: "/department/" + department_id,
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
