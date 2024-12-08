<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\ExpenseModel;


class RecurringController extends Controller
{

    public function index(){

        $users = ExpenseModel::all();
        //var_dump($users);
        return view('recurring.index', compact('users')); 
    }
   


    
}
