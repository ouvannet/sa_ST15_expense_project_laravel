@extends('layouts.app')

@section('title', 'Expense')

@push('js')
    <script src="/assets/plugins/apexcharts/dist/apexcharts.min.js"></script>
    <script src="/assets/js/demo/dashboard.demo.js"></script>
@endpush

@section('content')
    <h3>Expense Report</h3>
    <div class="row mt-3">
        <!-- BEGIN col-6 -->
        <div class="col-xl-3">
            <!-- BEGIN row -->
            <div class="row">
                <!-- BEGIN col-6 -->
                <div class="">
                    <!-- BEGIN card -->
                    <div class="card mb-3">
                        <!-- BEGIN card-body -->
                        <div class="card-body">
                            <div class="d-flex mb-4">
                                <div class="flex-grow-1">
                                    <h5 class="mb-1">Total Expenses</h5>
                                    <div>Show the total amount of expense.</div>
                                </div>
                                <a href="javascript:;" class="text-secondary"><i class="fa fa-redo"></i></a>
                            </div>

                            <div class="d-flex">
                                <div class="flex-grow-1">
                                    <h3 class="mb-1">${{ number_format($totalExpense, 2) }}</h3>
                                    
                                    <div class="text-success fw-600 fs-13px">
                                        <i class="fa fa-caret-up"></i> +3.59%
                                    </div>
                                </div>
                                <div
                                    class="w-50px h-50px bg-primary bg-opacity-20 rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="fa-solid fa-money-bill-wave text-primary"></i>
                                </div>
                            </div>
                        </div>
                        <!-- END card-body -->

                    </div>
                    <!-- END card -->

                </div>

                <!-- END row -->
            </div>
            <!-- END col-6 -->


        </div>
        <div class="col-xl-3">
            <!-- BEGIN row -->
            <div class="row">
                <!-- BEGIN col-6 -->
                <div class="">
                    <!-- BEGIN card -->
                    <div class="card mb-3">
                        <!-- BEGIN card-body -->
                        <div class="card-body">
                            <div class="d-flex mb-4">
                                <div class="flex-grow-1">
                                    <h5 class="mb-1">Approved</h5>
                                    <div>Show all the approved expense</div>
                                </div>
                                <a href="javascript:;" class="text-secondary"><i class="fa fa-redo"></i></a>
                            </div>

                            <div class="d-flex">
                                <div class="flex-grow-1">
                                    {{-- <h3 class="mb-1">${{ number_format($totalExpense, 2) }}</h3> --}}
                                    <h3 class="mb-1">{{$approvedCount}}</h3>
                                    <div class="text-success fw-600 fs-13px">
                                        <i class="fa fa-caret-up"></i> +3.59%
                                    </div>
                                </div>
                                <div
                                    class="w-50px h-50px bg-primary bg-opacity-20 rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="fa fa-thumbs-up text-primary"></i>
                                </div>
                            </div>
                        </div>
                        <!-- END card-body -->

                    </div>
                    <!-- END card -->

                </div>

                <!-- END row -->
            </div>
            <!-- END col-6 -->


        </div>
        <div class="col-xl-3">
            <!-- BEGIN row -->
            <div class="row">
                <!-- BEGIN col-6 -->
                <div class="">
                    <!-- BEGIN card -->
                    <div class="card mb-3">
                        <!-- BEGIN card-body -->
                        <div class="card-body">
                            <div class="d-flex mb-4">
                                <div class="flex-grow-1">
                                    <h5 class="mb-1">Completed</h5>
                                    <div>Show all the completed expense.</div>
                                </div>
                                <a href="javascript:;" class="text-secondary"><i class="fa fa-redo"></i></a>
                            </div>

                            <div class="d-flex">
                                <div class="flex-grow-1">
                                    {{-- <h3 class="mb-1">${{ number_format($totalExpense, 2) }}</h3> --}}
                                    <h3 class="mb-1">{{$completedCount}}</h3>
                                    <div class="text-success fw-600 fs-13px">
                                        <i class="fa fa-caret-up"></i> +3.59%
                                    </div>
                                </div>
                                <div
                                    class="w-50px h-50px bg-primary bg-opacity-20 rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="fa fa-circle-check text-primary"></i>
                                </div>
                            </div>
                        </div>
                        <!-- END card-body -->

                    </div>
                    <!-- END card -->

                </div>

                <!-- END row -->
            </div>
            <!-- END col-6 -->


        </div>
        <div class="col-xl-3">
            <!-- BEGIN row -->
            <div class="row">
                <!-- BEGIN col-6 -->
                <div class="">
                    <!-- BEGIN card -->
                    <div class="card mb-3">
                        <!-- BEGIN card-body -->
                        <div class="card-body">
                            <div class="d-flex mb-4">
                                <div class="flex-grow-1">
                                    <h5 class="mb-1">Canceled</h5>
                                    <div>Show all the canceled expense</div>
                                </div>
                                <a href="javascript:;" class="text-secondary"><i class="fa fa-redo"></i></a>
                            </div>

                            <div class="d-flex">
                                <div class="flex-grow-1">
                                    {{-- <h3 class="mb-1">${{ number_format($totalExpense, 2) }}</h3> --}}
                                    <h3 class="mb-1">{{$canceledCount}}</h3>
                                    <div class="text-success fw-600 fs-13px">
                                        <i class="fa fa-caret-up"></i> +3.59%
                                    </div>
                                </div>
                                <div
                                    class="w-50px h-50px bg-primary bg-opacity-20 rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="fa fa-circle-xmark text-primary"></i>
                                </div>
                            </div>
                        </div>
                        <!-- END card-body -->

                    </div>
                    <!-- END card -->

                </div>

                <!-- END row -->
            </div>
            <!-- END col-6 -->


        </div>

    </div>



    <div id="expensesTable" class="mb-5">
        <div class="card">
            <div class="card-body">
                <h5 class="mb-3 fw-bold">Expenses List</h5>
                <table class="table table-striped mb-0">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Reference</th>
                            <th scope="col">Category</th>
                            <th scope="col">User</th>
                            <th scope="col">Budget</th>
                            <th scope="col">Balance</th>
                            <th scope="col">Description</th>
                            <th scope="col">Attachment</th>
                            <th scope="col">Status</th>
                            <th scope="col">Assign</th>
                            <th scope="col">Date</th>

                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($expenses as $expense)
                            <tr id="expense-row-{{ $expense->id }}">
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    <a class="text-decoration-none btn btn-sm btn-primary"
                                        href="{{ route('expense.show', ['id' => $expense->id]) }}">
                                        {{ $expense->reference_number }}
                                    </a>
                                </td>
                                <td>{{ $expense->category->name ?? 'N/A' }}</td>
                                <td>{{ $expense->requester->name ?? 'N/A' }}</td> <!-- User who requested -->
                                <td>{{ $expense->budget }}</td>
                                <td>{{ $expense->budget_balance }}</td>
                                <td>{{ $expense->description }}</td>
                                <td>
                                    <a href="{{ $expense->attachment }}" class="btn btn-sm btn-light">
                                        <img src="/images/icon/attachment.png" width="15px">
                                    </a>
                                </td>
                       
                                <td>
                                    <span class="{{$expense->status == 'Approved' ? 'text-success' : ($expense->status == 'Canceled' ? 'text-danger' : ($expense->status == 'Pending' ? 'text-warning' : 'text-primary')) }}">{{$expense->status}}</span>
                                </td>     
                                <td>{{ $expense->approver->name ?? 'N/A' }}</td> <!-- User who approves -->
                                <td>{{ \Carbon\Carbon::parse($expense->date)->format('Y-m-d') }}</td>

                            </tr>
                        @empty
                            <tr>
                                <td colspan="11" class="text-center">No expenses available.</td>
                            </tr>
                        @endforelse

                    </tbody>
                </table>
            </div>
        </div>
    </div>




@endsection
