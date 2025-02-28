@extends('layouts.app')

@section('title', 'Expense')

@push('js')
    <script src="/assets/plugins/apexcharts/dist/apexcharts.min.js"></script>
    <script src="/assets/js/demo/dashboard.demo.js"></script>
@endpush

@section('content')
    <h3>Payment Report</h3>
    <div class="row mt-3">
        <!-- BEGIN col-6 -->
        <div class="col-xl-6">
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
                                    <h5 class="mb-1">Total Payment</h5>
                                    <div>Show all payment</div>
                                </div>
                                <a href="javascript:;" class="text-secondary"><i class="fa fa-redo"></i></a>
                            </div>

                            <div class="d-flex">
                                <div class="flex-grow-1">


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

        <div class="col-xl-6">
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
                                    <h5 class="mb-1">Total</h5>
                                    <div>Show all total amount</div>
                                </div>
                                <a href="javascript:;" class="text-secondary"><i class="fa fa-redo"></i></a>
                            </div>

                            <div class="d-flex">
                                <div class="flex-grow-1">


                                    <div class="text-success fw-600 fs-13px">
                                        <i class="fa fa-caret-up"></i> +3.59%
                                    </div>
                                </div>
                                <div
                                    class="w-50px h-50px bg-primary bg-opacity-20 rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="fa fa-pause text-primary"></i>
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
                <h5 class="mb-3 fw-bold">Recurring List </h5>
                <table class="table table-striped mb-0">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Expense ID</th>
                            <th scope="col">Reference</th>
                            <th scope="col">Expense Reference</th>
                            <th scope="col">Paid By</th>
                            <th scope="col">Amount</th>
                            <th scope="col">Used At</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($expense_usages as $usage)
                            <tr id="expense-row-{{ $usage->id }}">
                                <td>{{$loop->iteration }}</td>
                                <td>{{$usage->expense_id}}</td>
                                <td>{{$usage->reference_number ?? 'N/A'}}</td>
                                <td>{{$usage->expense_reference_number ?? 'N/A'}}</td>
                                <td>{{$usage->payment_method ?? 'N/A'}}</td>
                                <td>{{$usage->amount}}</td>
                                <td>{{ \Carbon\Carbon::parse($usage->used_at)->format('Y-m-d') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="11" class="text-center">No Payments available.</td>
                            </tr>
                        @endforelse

                    </tbody>
                </table>
            </div>
        </div>
    </div>



@endsection
