@extends('layouts.app')
@section('title', 'Expenses')
@section('content')

    <!-- Expenses Table -->
    <div id="expensesTable" class="mb-5">
        <div class="card">
            <div class="card-body">
                <h5 class="mb-3 fw-bold">Recurring Expense</h5>
                <button type="button" class="btn btn-primary mb-3">
                    Create Recurring
                </button>
                <table class="table table-striped mb-0">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Expense ID</th>
                           
                            <th scope="col">Type</th>
                            <th scope="col">Interval</th>
                            <th scope="col">Date</th>
                            <th scope="col">Date</th>
                    
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($recurring_expense as $recurring)
                            <tr id="recurring-row-{{ $recurring->id }}">
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $recurring->expense_id ?? 'N/A' }}</td>
                                <td>{{ $recurring->type ?? 'N/A' }}</td> 
                                <td>{{ $recurring->interval_time ?? 'N/A' }}</td>
                                <td>{{ $recurring->date ?? 'N/A' }}</td> 
                             
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

@endsection




@push('js')
@endpush
