<?php

namespace App\Http\Controllers;

use App\Models\RecurringModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\ExpenseModel;



class RecurringController extends Controller
{

    public function index(){

        $recurring_expense = RecurringModel::with(['expense'])->get();
        //dd($recurring_expense);

       // $recurring_expense = RecurringModel::all();
        return view('recurring.index', compact('recurring_expense')); 
    }
   


    
}
