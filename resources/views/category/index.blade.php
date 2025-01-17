@extends('layouts.app')



@section('title', 'Categories')
@section('content')

    <div id="categoriesTable" class="mb-5">
        <div class="card">
            <div class="card-body">
                <h5 class="mb-3 fw-bold">Categories List</h5>
                <button type="button" class="btn btn-primary mb-3" id="btn_add_category" data-bs-toggle="modal" data-bs-target="#addCategoryModal">
                    Add Category
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
                        @forelse ($categories as $category)
                            <tr id="category-row-{{ $category->id }}">
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $category->name }}</td>
                                <td>{{ $category->description }}</td>
                                <td class="d-flex justify-content-end gap-2">
                                    <!-- Edit Button -->
                                    <button onclick="edit_category({{$category->id}})" class="btn btn-sm btn-warning edit-btn px-3" data-id="{{ $category->id }}"
                                        data-name="{{ $category->name }}" data-description="{{ $category->description }}">
                                        Edit
                                    </button>

                                    <!-- Delete Button -->
                                    <button onclick="delete_category({{$category->id}})" class="btn btn-sm btn-danger delete-btn px-3" data-id="{{ $category->id }}">
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


        $("#btn_add_category").click(function() {
            $.ajax({
                url: "{{route('category.add') }}",
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


        
        $(document).on('click',"#btn_submit_category",function(){
            const formData = $("#addCategoryForm").serializeArray();
            console.table(formData);
            $.ajax({
                url: "{{route('category.submit_add') }}",
                type: 'POST',
                data: formData,
                success: function (response) {
                    console.log(response);
                    if(response.status==1){
                        $("#globalModalView").modal('toggle');
                        Swal.fire({
                            title: response.message,
                            icon: "success",
                            draggable: true
                        });
                        reloadPage();
                    }
                },
                error: function (xhr) {
                    console.log(xhr);
                    
                }
            });
        })


        function edit_category(category_id){
            console.log(category_id);
            $.ajax({
                url: `/category/${category_id}/edit`,
                type: 'GET',
                success: function (response) {
                    console.log(response);
                    $("#globalModalView").html(response);
                    $("#globalModalView").modal('toggle');
                },
                error: function (xhr) {
                    console.log(xhr);  
                }
            });
        }


        $(document).on('click',"#btn_submit_edit_category",function(){
            const formData = $("#addCategoryForm").serializeArray();
            
            console.table(formData);
            $.ajax({
                url: "/category",
                type: 'PUT',
                data: formData,
                success: function (response) {
                    console.log(response);
                    if(response.status==1){
                        $("#globalModalView").modal('toggle');
                        Swal.fire({
                            title: response.message,
                            icon: "success",
                            draggable: true
                        });
                        reloadPage();
                    }
                },
                error: function (xhr) {
                    console.log(xhr);
                    
                }
            });
        })

        function delete_category(category_id){
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
                        url: "/category/"+category_id,
                        type: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function (response) {
                            console.log(response);
                            if(response.status==1){
                                Swal.fire({
                                    title: "Deleted!",
                                    text: response.message,
                                    icon: "success"
                                });
                                reloadPage();
                            }
                        },
                        error: function (xhr) {
                            console.log(xhr);
                            
                        }
                    });
                }
            });
        }






    </script>
@endpush
