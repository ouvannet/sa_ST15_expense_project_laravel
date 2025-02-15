 <div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="editRecurringLabel">Edit Recurring</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form id="addRecurringForm">
                @csrf
                <input type="hidden" name="recurring_id" value="{{$recurring->id}}">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="amount" class="form-label">Amount</label>
                        <input type="number" class="form-control" id="amount" name="amount"
                            value="{{ $recurring->amount }}" required>
                    </div>
                   
                    <div class="col-md-6 mb-3">
                        <label for="category_id" class="form-label">Category</label>
                        <select class="form-select" id="category_id" name="category_id" required>
                            <option value="" disabled>Select Category</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" {{ $category->id == $recurring->category_id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="frequency" class="form-label">Frequency</label>
                        <select class="form-select" id="frequency" name="frequency" required>
                            <option value="" disabled>Select Type</option>
                            <option value="daily" {{ $recurring->frequency == 'daily' ? 'selected' : '' }}>Daily</option>
                            <option value="weekly" {{ $recurring->frequency == 'weekly' ? 'selected' : '' }}>Weekly</option>
                            <option value="monthly" {{ $recurring->frequency == 'monthly' ? 'selected' : '' }}>Monthly</option>
                            <option value="yearly" {{ $recurring->frequency == 'yearly' ? 'selected' : '' }}>Yearly</option>
                        </select>
                        
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="start_date" class="form-label">Start Date</label>
                        <input type="date" class="form-control" id="start_date" name="start_date" value="{{ \Carbon\Carbon::parse($recurring->start_date)->format('Y-m-d') }}"  required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="end_date" class="form-label">End Date</label>
                        <input type="date" class="form-control" id="end_date" name="end_date" value="{{ \Carbon\Carbon::parse($recurring->end_date)->format('Y-m-d') }}" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-select" id="status" name="status" required>
                            <option value="" disabled>Select Status</option>
                            <option value="active" {{ $recurring->status == 'active' ? 'selected' : '' }}>Active</option>
                            <option value="inactive" {{ $recurring->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
                            <option value="canceled" {{ $recurring->status == 'canceled' ? 'selected' : '' }}>Canceled</option>
                        </select>
                        
                    </div>
                </div>

                <div class="text-end">
                    <button id="btn_submit_edit_recurring" type="button" class="btn btn-success">Update Recurring</button>
                </div>
            </form>

        </div>
    </div>
</div> 


