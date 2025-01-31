<?php

namespace App\Http\Controllers;

use App\Models\RecurringModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\ExpenseModel;

use App\Models\CategoryModel;



class RecurringController extends Controller
{

    public function index()
    {

        $recurring_expense = RecurringModel::with(['expense'])->get();
        //dd($recurring_expense);

        // $recurring_expense = RecurringModel::all();
        $categories = CategoryModel::all();

        return view('recurring.index', compact('recurring_expense', 'categories'));
    }

    public function add()
    {
        return view('recurring.action.add');
    }

    public function submit_add(Request $req)
    {
        $all=$req->all();
        $ins = RecurringModel::create([
            "category_id" => $all['category_id'],
            "amount" => $all['amount'],
            "frequency" => $all['frequency'], 
            "start_date" => $all['start_date'],
            "end_date" => $all['end_date'],
     
        ]);

        if($ins){
            $message=['status'=>1,'message'=>'Category Inserted Successfully.'];
        }else{
            $message=['status'=>0,'message'=>'Category Inserted Fail'];
        }
        return ($message);
    }




}
