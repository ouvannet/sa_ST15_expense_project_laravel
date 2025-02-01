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

        $recurring_expense = RecurringModel::with(['expense','category'])->get();
        //dd($recurring_expense);

        // $recurring_expense = RecurringModel::all();
        $categories = CategoryModel::all();

        return view('recurring.index', compact('recurring_expense', 'categories'));
    }

    public function add()
    {
        $categories = CategoryModel::all();
        return view('recurring.action.add',compact('categories'));
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


    public function edit($recurring_id){
        $recurring=RecurringModel::find($recurring_id);
        $categories = CategoryModel::all();
       // return view('recurring.action.edit',['recurring'=> $recurring,'categories' => $categories]);
        return view('recurring.action.edit', compact('recurring','categories'));
    }


    public function update(Request $req)
    {
        $all= $req->all();
        $recurring=RecurringModel::find($all['recurring_id']);
        $recurring->category_id=$all['category_id'];
        $recurring->amount=$all['amount'];
        $recurring->frequency=$all['frequency'];
        $recurring->start_date=$all['start_date'];
        $recurring->end_date=$all['end_date'];
        $recurring->status=$all['status'];

        $upd=$recurring->save();
        
        if($upd){
            $message=['status'=>1,'message'=>'Edit Permission Success'];
        }else{
            $message=['status'=>0,'message'=>'Edit Permission Failed'];
        }
        return ($message);
    }

    public function destroy($recurring_id)
    {
        $recurring = RecurringModel::find($recurring_id);
        if ($recurring) {
            $recurring->delete();
            $message=['status'=>1,'message'=>'Delete Permission Success'];
        }else{
            $message=['status'=>0,'message'=>'Delete Permission Failed'];
        }
        return ($message);
    }





}
