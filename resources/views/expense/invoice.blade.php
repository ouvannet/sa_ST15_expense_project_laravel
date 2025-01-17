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
                    <td><a href="{{ $attachment }}">View Attachment</a></td>
                </tr>
            @endif
        </tbody>
    </table>

    <div class="text-center mt-4">
        <p>Thank you for using our service!</p>
    </div>
</div>
