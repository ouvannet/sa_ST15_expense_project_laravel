<div class="container border p-4 rounded">
    <div class="text-center mb-4">
        <h1>Invoice</h1>
        <p class="text-muted">Generated on {{ now()->format('Y-m-d') }}</p>
    </div>

    <table class="table table-bordered">
        <tbody>
            <tr>
                <th>Reference Number</th>
                <td>{{ $reference_number }}</td>
            </tr>
            <tr>
                <th>Category</th>
                <td>{{ $category_name }}</td>
            </tr>
            <tr>
                <th>User</th>
                <td>{{ $user_name }}</td>
            </tr>
            <tr>
                <th>Assign</th>
                <td>{{ $assign_name }}</td>
            </tr>
            <tr>
                <th>Budget</th>
                <td>${{ number_format($budget, 2) }}</td>
            </tr>
            <tr>
                <th>Budget Balance</th>
                <td>${{ number_format($budget_balance, 2) }}</td>
            </tr>
            <tr>
                <th>Description</th>
                <td>{{ $description }}</td>
            </tr>
            <tr>
                <th>Status</th>
                <td>{{ $status }}</td>
            </tr>
            <tr>
                <th>Date</th>
                <td>{{ $date }}</td>
            </tr>
            @if ($attachment)
                <tr>
                    <th>Attachment</th>
                    <td><a href="{{ $attachment }}" target="_blank">View Attachment</a></td>
                </tr>
            @endif
        </tbody>
    </table>

    <!-- Usage Section -->
    <h3 class="mt-4">Expense Usages</h3>
    <table class="table table-bordered mt-2">
        <thead>
            <tr>
                <th>#</th>
                <th>Used at</th>
                <th>Amount</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($usages as $index => $usage)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $usage->used_at }}</td>
                    <td>${{ number_format($usage->amount, 2) }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="text-center">No usage records available.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="text-center mt-4">
        <p>Thank you for using our service!</p>
    </div>
</div>
