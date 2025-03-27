<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="addExpenseLabel">Add User</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form id="adduserForm">
                @csrf
                <div class="row">
                    <!-- Budget -->
                    <div class="col-md-6 mb-3">
                        <label for="budget" class="form-label">Name</label>
                        <input name="name" type="text" class="form-control" value="test" required>
                    </div>
                    <!-- Balance -->
                    <div class="col-md-6 mb-3">
                        <label for="balance" class="form-label">Gender</label>
                        <select name="gender" class="form-select" required>
                            <option value="male" selected>Male</option>
                            <option value="female">Female</option>
                        </select>
                    </div>
                    <!-- Date -->
                    <div class="col-md-6 mb-3">
                        <label for="date" class="form-label">Dob</label>
                        <input name="dob" type="date" class="form-control"  value="{{ now()->format('Y-m-d') }}" required>
                    </div>
                    <!-- Budget -->
                    <div class="col-md-6 mb-3">
                        <label for="budget" class="form-label">Email</label>
                        <input name="email" type="email" class="form-control" value="test11@gmail.com" required>
                    </div>
                    <!-- Description -->
                    <div class="col-md-6 mb-3">
                        <label for="description" class="form-label">Phone</label>
                        <input name="phone" type="text" class="form-control" value="23232323" required>
                    </div>
                    <!-- Description -->
                    <div class="col-md-6 mb-3">
                        <label for="description" class="form-label">Password</label>
                        <input name="password" type="text" class="form-control" value="123" required>
                    </div>
                    <!-- Status -->
                    <div class="col-md-6 mb-3">
                        <label for="status" class="form-label">Department</label>
                        <select name="department" class="form-select" required>
                            @foreach ($department as $dep)
                                <option value="{{ $dep->id }}" {{ $dep === 0 ? 'selected' : '' }}>{{ $dep->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <!-- Status -->
                    <div class="col-md-6 mb-3">
                        <label for="status" class="form-label">Role</label>
                        <select name="role" class="form-select" required>
                            @foreach ($role as $rol)
                                <option value="{{ $rol->id }}" {{ $rol === 0 ? 'selected' : '' }}>{{ $rol->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="text-end">
                    <button id="btn_submit_add_user" type="button" class="btn btn-success">Add User</button>
                </div>
            </form>
        </div>
    </div>
</div>