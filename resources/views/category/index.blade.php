
@extends('layouts.app')

@section('title', 'Categories')

@section('content')
    <div id="categoriesTable" class="mb-5">
        <div class="card">
            <div class="card-body">
                <h5 class="mb-3 fw-bold">Categories List</h5>
                <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addCategoryModal">
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
                                    <button class="btn btn-sm btn-warning edit-btn px-3" data-id="{{ $category->id }}"
                                        data-name="{{ $category->name }}" data-description="{{ $category->description }}">
                                        Edit
                                    </button>

                                    <!-- Delete Button -->
                                    <button class="btn btn-sm btn-danger delete-btn px-3" data-id="{{ $category->id }}">
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

    <!-- Add Category Modal -->
    <div class="modal fade" id="addCategoryModal" tabindex="-1" aria-labelledby="addCategoryLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addCategoryLabel">Add Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addCategoryForm">
                        <div class="mb-3">
                            <label for="add-name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="add-name" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="add-description" class="form-label">Description</label>
                            <input type="text" class="form-control" id="add-description" name="description">
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-success">Add Category</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!-- Edit Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editCategoryForm">
                        @csrf
                        @method('PUT')
                        <input type="hidden" id="edit-category-id">
                        <div class="mb-3">
                            <label for="edit-name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="edit-name" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit-description" class="form-label">Description</label>
                            <textarea class="form-control" id="edit-description"></textarea>
                        </div>
                        <button type="submit" class="btn btn-success">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Confirm Delete</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this category?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" id="confirmDeleteBtn" class="btn btn-danger">Delete</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        // Global category ID for delete
        let deleteId = null;

        document.getElementById('addCategoryForm').addEventListener('submit', function(e) {
            e.preventDefault();

            const formData = {
                name: document.getElementById('add-name').value,
                description: document.getElementById('add-description').value,
            };

            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            fetch('/category', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify(formData),
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        location.reload(); // Reload to update the table
                    } else {
                        alert('Error: ' + data.message);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Something went wrong. Check the console for details.');
                });
        });




        // Edit Button - Opens the Edit Modal
        document.querySelectorAll('.edit-btn').forEach(button => {
            button.addEventListener('click', function() {
                const id = this.dataset.id;
                const name = this.dataset.name;
                const description = this.dataset.description;

                // Populate the modal fields
                document.getElementById('edit-category-id').value = id;
                document.getElementById('edit-name').value = name;
                document.getElementById('edit-description').value = description;

                // Show the modal
                new bootstrap.Modal(document.getElementById('editModal')).show();
            });
        });

        // Submit Edit Form via AJAX
        document.getElementById('editCategoryForm').addEventListener('submit', function(e) {
            e.preventDefault();
            console.log("Edit form submitted");

            const id = document.getElementById('edit-category-id').value;
            const name = document.getElementById('edit-name').value;
            const description = document.getElementById('edit-description').value;

            fetch(`/category/${id}`, {
                    method: 'PUT',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        name,
                        description
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        location.reload(); // Reload table
                    } else {
                        alert('Error updating category');
                    }
                });
        });

        // Delete Button - Opens the Delete Modal
        document.querySelectorAll('.delete-btn').forEach(button => {
            button.addEventListener('click', function() {
                deleteId = this.dataset.id;
                new bootstrap.Modal(document.getElementById('deleteModal')).show();
            });
        });

        // Confirm Delete Button
        document.getElementById('confirmDeleteBtn').addEventListener('click', function() {
            fetch(`/category/${deleteId}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                    
                        document.getElementById(`category-row-${deleteId}`).remove();
                        bootstrap.Modal.getInstance(document.getElementById('deleteModal')).hide();
                    } else {
                        alert('Error deleting category');
                    }
                });
        });
    </script>
@endpush
