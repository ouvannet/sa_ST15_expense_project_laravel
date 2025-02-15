@extends('layouts.app')

@section('title', 'Recurring_expense')

@push('js')
    <script src="/assets/plugins/apexcharts/dist/apexcharts.min.js"></script>
    <script src="/assets/js/demo/dashboard.demo.js"></script>
@endpush




@section('content')
    <h3>Recurring Report</h3>
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
                                    <h5 class="mb-1">Total Recurring Amount</h5>
                                    <div>Show all amount of recurring amount</div>
                                </div>
                                <a href="javascript:;" class="text-secondary"><i class="fa fa-redo"></i></a>
                            </div>

                            <div class="d-flex">
                                <div class="flex-grow-1">
                                    <h3 class="mb-1">${{ number_format($totalRecurringExpense, 2) }}</h3>
                                 
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
                                    <h5 class="mb-1">Active</h5>
                                    <div>Show all the active recurring</div>
                                </div>
                                <a href="javascript:;" class="text-secondary"><i class="fa fa-redo"></i></a>
                            </div>

                            <div class="d-flex">
                                <div class="flex-grow-1">
                                    <h3>{{$activeCount}}</h3>
                              
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
                                    <h5 class="mb-1">Paused</h5>
                                    <div>Show all the inactive recurring</div>
                                </div>
                                <a href="javascript:;" class="text-secondary"><i class="fa fa-redo"></i></a>
                            </div>

                            <div class="d-flex">
                                <div class="flex-grow-1">
                                    <h3>{{$pausedCount}}</h3>
                                    
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
                                    <div>Show all the canceled recurring</div>
                                </div>
                                <a href="javascript:;" class="text-secondary"><i class="fa fa-redo"></i></a>
                            </div>

                            <div class="d-flex">
                                <div class="flex-grow-1">
                                    <h3>{{$canceledCount}}</h3>
                                
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
                <h5 class="mb-3 fw-bold">Recurring List </h5>
                

                <table class="table table-striped mb-0">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Category</th>
                            <th scope="col">Amount</th>
                            <th scope="col">Frequency</th>
                            <th scope="col">Start Date</th>
                            <th scope="col">End Date</th>
                            <th scope="col">Next Date</th>
                            <th scope="col">Status</th>
                      

                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($recurring_expense as $recurring)
                            <tr id="recurring-row-{{ $recurring->id }}">
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $recurring->category->name ?? 'N/A' }}</td>

                                <td>{{ $recurring->amount ?? 'N/A' }}</td>
                                <td>{{ $recurring->frequency ?? 'N/A' }}</td>
                                <td>{{ $recurring->start_date ?? 'N/A' }}</td>
                                <td>{{ $recurring->end_date ?? 'N/A' }}</td>
                                <td>{{ $recurring->next_run_date ?? 'N/A' }}</td>
                                <td class=" {{ $recurring->status == 'active' ? 'text-success' : 'text-danger' }} ">
                                    {{ $recurring->status ?? 'N/A' }}</td>

                            </tr>
                        @empty
                            <tr>
                                <td colspan="11" class="text-center">No Recurring Expense is there</td>
                            </tr>
                        @endforelse


                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
