<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\ExpenseModel;
use App\Models\RecurringModel;
use App\Models\CategoryModel;

class RecurringReportController extends Controller
{

    public function index()
    {


        $recurring_expense = RecurringModel::with(['expense', 'category'])->get();
        //dd($recurring_expense);

        $categories = CategoryModel::all();
        $expenses = DB::table('tbl_expense')->get();

        $totalRecurringExpense = DB::table('tbl_recurring_expense')
            ->where('status', 'active')
            ->sum('amount');

        // Count records for each status
        $activeCount = DB::table('tbl_recurring_expense')->where('status', 'active')->count();
        $pausedCount = DB::table('tbl_recurring_expense')->where('status', 'inactive')->count();
        $canceledCount = DB::table('tbl_recurring_expense')->where('status', 'Canceled')->count();

        return view('reports.recurring_report.index', compact('recurring_expense', 'categories', 'expenses','totalRecurringExpense','activeCount','pausedCount','canceledCount'));
    }













}

