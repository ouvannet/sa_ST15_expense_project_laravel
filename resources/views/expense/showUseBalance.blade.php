@extends('layouts.app')
@section('title', 'Expenses')
@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header bg-white d-flex justify-content-between align-items-center">
                <h3>Manage Expense</h3>
                <a href="{{ route('Expense') }}" class="btn btn-secondary btn-sm">Back</a>
            </div>
            <div class="card-body">
                {{-- <div class="row mb-4">
                    <div class="col-md-6 bg-red">
                        <p><strong>Reference Number: </strong> {{ $expense->reference_number }}</p>
                        <p>Category: {{ $expense->category->name ?? 'N/A' }}</p>
                        <p>User: {{ $expense->user->name ?? 'N/A' }}</p>
                        <p>Department: {{ $expense->user->department_id ?? 'N/A' }}</p>
                    </div>
                    <div class="col-md-6 bg-green">
                        <p><strong>Budget:</strong> {{ number_format($expense->budget, 2) }} USD</p>
                        <p>Balance:</strong>
                            <span class="{{ $expense->budget_balance > 0 ? 'text-success' : 'text-danger' }}">
                                {{ number_format($expense->budget_balance, 2) }} USD
                            </span>
                        </p>
                        <p>Status:</strong>
                            <span class="badge {{ $expense->budget_balance > 0 ? 'bg-success' : 'bg-danger' }}">
                                {{ $expense->budget_balance > 0 ? 'Active' : 'Exhausted' }}
                            </span>
                        </p>
                    </div>
                </div> --}}


                <div class="row">
                    <!-- BEGIN col-6 -->
                    <div class="col-xl-6 mb-3">
                        <!-- BEGIN row -->
                        <div class="row">
                            <!-- BEGIN col-6 -->
                            <div class="col-sm-6 ">
                                <!-- BEGIN card -->
                                <div class="card">
                                    <!-- BEGIN card-body -->
                                    <div class="card-body">
                                        <div class="d-flex mb-4">
                                            <div class="flex-grow-1">
                                                <h5 class="mb-1">Reference Number:</h5>
                                            </div>
                                        </div>
                                        <div class="d-flex">
                                            <div class="flex-grow-1">
                                                <h3 class="mb-1">{{ $expense->reference_number }}</h3>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- END card-body -->
                                </div>
                                <!-- END card -->
                                <div class="card mt-4">
                                    <!-- BEGIN card-body -->
                                    <div class="card-body">
                                        <div class="d-flex mb-4">
                                            <div class="flex-grow-1">
                                                <h5 class="mb-1">Category:</h5>

                                            </div>

                                        </div>

                                        <div class="d-flex">
                                            <div class="flex-grow-1">
                                                <h3 class="mb-1">{{ $expense->category->name }}</h3>

                                            </div>

                                        </div>
                                    </div>
                                    <!-- END card-body -->

                                </div>
                               

                            </div>
                            <!-- END col-6 -->


                            <div class="col-sm-6 d-flex flex-column">
                                <!-- BEGIN card -->
                                <div class="card">
                                    <!-- BEGIN card-body -->
                                    <div class="card-body">
                                        <div class="d-flex mb-4">
                                            <div class="flex-grow-1">
                                                <h5 class="mb-1">User:</h5>

                                            </div>
                                        </div>
                                        <div class="d-flex">
                                            <div class="flex-grow-1">
                                                <h3 class="mb-1">{{ $expense->user->name}}</h3>
                                            </div>

                                        </div>
                                    </div>
                                    <!-- END card-body -->

                                </div>
                                <!-- END card -->
                                <div class="card mt-4">
                                    <!-- BEGIN card-body -->
                                    <div class="card-body">
                                        <div class="d-flex mb-4">
                                            <div class="flex-grow-1">
                                                <h5 class="mb-1">Department</h5>

                                            </div>

                                        </div>

                                        <div class="d-flex">
                                            <div class="flex-grow-1">
                                                <h3 class="mb-1">{{ $expense->user->department_id}}</h3>

                                            </div>

                                        </div>
                                    </div>
                                    <!-- END card-body -->
                                </div>
                            </div>
                        </div>
                        <!-- END row -->
                    </div>
                    <!-- END col-6 -->


                    <!-- BEGIN col-6 -->
                    <div class="col-sm-6 mb-3 d-flex flex-row align-items-stretch">
                        <!-- BEGIN card -->
                        <div class="card h-100 flex-fill">
                            <!-- BEGIN card-body -->
                            <div class="card-body">
                                <div class="d-flex mb-4">
                                    <div class="flex-grow-1">
                                        <h5 class="mb-1">Budget:</h5>
                                       
                                    </div>
                                
                                </div>
                                <div class="d-flex">
                                    <div class="flex-grow-1">
                                        <h3 class="mb-1">{{ $expense->budget }}</h3>
                                    </div>
                                </div>
                            </div>
                            <!-- END card-body -->
                        </div>
                        <div class="card h-100 flex-fill mx-4">
                            <!-- BEGIN card-body -->
                            <div class="card-body">
                                <div class="d-flex mb-4">
                                    <div class="flex-grow-1">
                                        <h5 class="mb-1">Balance:</h5>
                                    </div>
                                    

                                </div>
                                <div class="d-flex">
                                    <div class="flex-grow-1">
                                        <h3 class="mb-1">{{ $expense->budget_balance }}</h3>
                                    </div>
                                </div>
                            </div>
                            <!-- END card-body -->
                        </div>
                        <div class="card h-100 flex-fill">
                            <!-- BEGIN card-body -->
                            <div class="card-body">
                                <div class="d-flex mb-4">
                                    <div class="flex-grow-1">
                                        <h5 class="mb-1">Status:</h5>
                                    </div>
                                </div>
                                <div class="d-flex">
                                    <div class="flex-grow-1">
                                        <h3 class="mb-1">{{ $expense->user->department_id }}</h3>
                                    </div>
                                </div>
                            </div>
                            <!-- END card-body -->
                        </div>
                    </div>
                    <!-- END col-6 -->
                    










                @if ($expense->budget_balance > 0)
                    <form action="{{ route('expense.use', ['id' => $expense->id]) }}" method="POST"
                        class="needs-validation" novalidate>
                        @csrf
                        <div class="mb-3">
                            <label for="amount" class="form-label"><strong>Amount to Use:</strong></label>
                            <input type="number" class="form-control" id="amount" name="amount"
                                placeholder="Enter amount to use" min="1" max="{{ $expense->budget_balance }}"
                                required>
                            <div class="invalid-feedback">
                                Please enter a valid amount within the available balance.
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="payment_method" class="form-label"><strong>Payment Method:</strong></label>
                            <select class="form-select" id="payment_method" name="payment_method" required>
                                <option value="" disabled selected>Select Payment Method</option>
                                <option value="Cash">Cash</option>
                                <option value="ABA">ABA</option>
                                <option value="KHQR">KHQR</option>
                                <option value="Paypal">PayPal</option>
                            </select>
                            <div class="invalid-feedback">
                                Please select a valid payment method.
                            </div>
                        </div>
                        <button type="submit" id="btn_submit_use_expense" class="btn btn-primary">Use Balance</button>
                    </form>
                @else
                    <p class="text-danger"><strong>Note:</strong> The budget for this expense has been fully utilized.</p>
                @endif
            </div>
        </div>


        <div class="card mt-4">
            <div class="card-header bg-white">
                <h4>Usage History</h4>
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Amount Used</th>
                            <th>Used At</th>
                            <th>Expense Reference</th>
                            <th>Payment Reference</th>
                            <th>Payment Method</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($expense->usages as $usage)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ number_format($usage->amount, 2) }} USD</td>
                                <td>{{ $usage->used_at }}</td>
                                <td>{{ $usage->expense_reference_number }}</td>
                                <td>{{ $usage->reference_number }}</td>
                                <td>{{ $usage->payment_method }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="12" class="text-center">No usage history found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>

    <script>
        // Bootstrap validation
        (() => {
            'use strict';
            const forms = document.querySelectorAll('.needs-validation');
            Array.from(forms).forEach(form => {
                form.addEventListener('submit', event => {
                    if (!form.checkValidity()) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        })();
    </script>
@endsection
