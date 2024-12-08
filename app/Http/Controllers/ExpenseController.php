<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\ExpenseModel;
use App\Models\UserModel;


class ExpenseController extends Controller
{

    public function index(){

        $users = UserModel::find(1);
        return view('expense.index', compact('users')); 
    }
   


    
}
