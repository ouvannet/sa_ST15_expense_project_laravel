<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\ExpenseModel;
use App\Models\ExpenseUsageModel;




class PaymentReportController extends Controller
{

    public function index(){


        $expense_usages = ExpenseUsageModel::all();

        $paymentCount = DB::table('tbl_expense_usage')->count();
        $totalPayment = DB::table('tbl_expense_usage')->sum('amount');

        return view('reports.payment_report.index', compact('expense_usages','paymentCount','totalPayment'));
    }







}
