<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\DashBoardModel;


class DashboardController extends Controller
{

    public function index()
    {

        $expenses = DashBoardModel::with(['category'])->get();

        $recurrings = DB::table('tbl_recurring_expense')->get();
        $totalBudget = DB::table('tbl_expense')->sum('budget');

        $totalExpense = DB::table('tbl_expense')
            ->whereIn('status', ['Completed', 'Approved'])
            ->sum('budget');

        $totalPayment = DB::table('tbl_expense_usage')->sum('amount');
        $totalRecurring = DB::table('tbl_recurring_expense')
            ->where('status', 'active')
            ->sum('amount');




        return view('dashboard.index', compact('expenses', 'totalBudget', 'totalExpense', 'totalPayment', 'totalRecurring', 'recurrings'));
    }




}
