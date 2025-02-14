<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\ExpenseModel;


class RecurringReportController extends Controller
{

    public function index(){

        $users = ExpenseModel::all();
    
        return view('reports.recurring_report.index', compact('users')); 
    }








    
   


    
}
