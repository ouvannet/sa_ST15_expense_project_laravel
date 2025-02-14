<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\ExpenseModel;
use App\Models\CategoryModel;
use App\Models\UserModel;


class ExpenseReportController extends Controller
{

    public function index()
    {

        $expenses = ExpenseModel::with(['category', 'requester', 'approver'])->get();
        $categories = CategoryModel::all();
        $users = UserModel::all();

        $totalExpense = DB::table('tbl_expense')
            ->where('status', 'Approved')
            ->sum('budget');

        // Count records for each status
        $approvedCount = DB::table('tbl_expense')->where('status', 'Approved')->count();
        $completedCount = DB::table('tbl_expense')->where('status', 'Completed')->count();
        $canceledCount = DB::table('tbl_expense')->where('status', 'Canceled')->count();

        return view('reports.expense_report.index', compact('users', 'categories', 'expenses', 'totalExpense', 'approvedCount', 'completedCount', 'canceledCount'));
    }













}
