

@extends('layouts.app')
@section('title', 'Expenses')
@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h3>Manage Expense</h3>
                <a href="{{ route('Expense') }}" class="btn btn-secondary btn-sm">Back</a>
            </div>
            <div class="card-body">
                <div class="row mb-4">
                    <div class="col-md-6">
                        <p><strong>Reference Number: </strong> {{ $expense->reference_number }}</p>
                        <p>Category: {{ $expense->category->name ?? 'N/A' }}</p>
                        <p>User: {{ $expense->user->name ?? 'N/A' }}</p>
                        <p>Department: {{ $expense->us->name ?? 'N/A' }}</p>
                    </div>
                    <div class="col-md-6">
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
                </div>

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
                        <button type="submit" class="btn btn-primary">Use Balance</button>
                    </form>
                @else
                    <p class="text-danger"><strong>Note:</strong> The budget for this expense has been fully utilized.</p>
                @endif
            </div>
        </div>

        
            <div class="card mt-4">
                <div class="card-header">
                    <h4>Usage History</h4>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Amount Used</th>
                                <th>Used At</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($expense->usages as $usage)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ number_format($usage->amount, 2) }} USD</td>
                                    <td>{{ $usage->used_at }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center">No usage history found.</td>
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
