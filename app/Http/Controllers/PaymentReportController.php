<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\ExpenseModel;


class PaymentReportController extends Controller
{

    public function index(){

        $users = ExpenseModel::all();
    
        return view('reports.payment_report.index', compact('users')); 
    }








    
   


    
}
