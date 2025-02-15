<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\User;
use App\Models\DashBoardModel;




class DashboardController extends Controller
{

    public function index(){

        //$expenses = DashboardModel::all();
        //$expenses = DashBoardModel::table('tbl_categories')->get();

        $expenses = DashBoardModel::with(['category'])->get();

        $recurrings = DB::table('tbl_recurring_expense')->get();
        $totalBudget = DB::table('tbl_expense')->sum('budget');
     
        $totalExpense = DB::table('tbl_expense')
        ->where('status', 'Approved')
        ->sum('budget');

        $totalPayment = DB::table('tbl_expense_payment')->sum('amount');
        $totalRecurring = DB::table('tbl_recurring_expense')->sum('amount');
    
        //dd($total_expense);

        return view('dashboard.index',compact('expenses','totalBudget','totalExpense', 'totalPayment', 'totalRecurring','recurrings'));
    }
   


    
}
