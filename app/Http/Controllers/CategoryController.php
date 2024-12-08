<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\ExpenseModel;


class CategoryController extends Controller
{

    public function index(){

        $users = ExpenseModel::all();
        
        return view('category.index', compact('users')); 
    }
   


    
}
