<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\User;
use App\Models\DashBoardModel;




class DashboardController extends Controller
{

    public function index(){

        $total_expense = DashboardModel::all();
        $totalBudget = DB::table('tbl_expense')->sum('budget');

        $totalExpense = DB::table('tbl_expense_usage')->sum('amount');
        $totalPayment = DB::table('tbl_expense_payment')->sum('amount');
        $totalRecurring = DB::table('tbl_recurring_expense')->sum('amount');
    
        //dd($total_expense);

        return view('dashboard.index',compact('totalBudget','totalExpense', 'totalPayment', 'totalRecurring'));
    }
   


    
}
