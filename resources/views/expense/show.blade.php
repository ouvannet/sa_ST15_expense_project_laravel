@extends('layouts.app')
@section('title', 'Expensesdsjfksjfs')
@section('content')
<div class="container">
    <h3>Manage Expense: {{ $expense->reference_number }}</h3>
    <p><strong>Category:</strong> {{ $expense->category_name }}</p>
    <p><strong>User:</strong> {{ $expense->user_name }}</p>
    <p><strong>Budget:</strong> {{ $expense->budget }}</p>
    <p><strong>Balance:</strong> {{ $expense->budget_balance }}</p>

    @if ($expense->budget_balance > 0)
        <form action="{{ route('expense.use', ['id' => $expense->id]) }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="amount" class="form-label">Amount to Use:</label>
                <input type="number" class="form-control" id="amount" name="amount" min="1" max="{{ $expense->budget_balance }}" required>
            </div>
            <button type="submit" class="btn btn-primary">Use Balance</button>
        </form>
    @else
        <p class="text-danger">No balance available for this expense.</p>
    @endif
</div>
@endsection
