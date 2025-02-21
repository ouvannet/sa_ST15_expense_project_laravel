<?php

namespace App\Http\Controllers;

use App\Models\RecurringModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\ExpenseModel;

use App\Models\CategoryModel;
use Carbon\Carbon;


class RecurringController extends Controller
{

    public function index()
    {

        $recurring_expense = RecurringModel::with(['expense', 'category','user'])->get();
        //dd($recurring_expense);

        $categories = CategoryModel::all();
        $expenses = DB::table(  'tbl_expense')->get(); // Fetch all expenses
        return view('recurring.index', compact('recurring_expense', 'categories','expenses'));
    }

    public function add()
    {
        $categories = CategoryModel::all();

        $expenses = DB::table('tbl_expense')->select('id', 'reference_number', 'budget', 'status', 'categories_id','user_id')->get();
        return view('recurring.action.add', compact('categories','expenses'));
    }


    public function submit_add(Request $req)
    {
        $all = $req->all();
        $expense = DB::table('tbl_expense')->where('id', $req->expense_id)->first();

        if (!$expense) {
            return response()->json(['status' => 0, 'message' => 'Expense not found']);
        }

        // dd($expense);

    
        $startDate = Carbon::parse($all['start_date']);

        switch ($all['frequency']) {
            case 'daily':
                $nextRunDate = $startDate->addDay();
                break;
            case 'weekly':
                $nextRunDate = $startDate->addWeek();
                break;
            case 'monthly':
                $nextRunDate = $startDate->addMonth();
                break;
            case 'yearly':
                $nextRunDate = $startDate->addYear();
                break;
            default:
                $nextRunDate = $startDate; 
                break;
        }


        $ins = RecurringModel::create([
            "category_id" => $all['category_id'],
            "user_id" => $all['user_id'],
            "amount" => $all['amount'],
            "frequency" => $all['frequency'],
            "start_date" => $all['start_date'],
            "end_date" => $all['end_date'],
            "status" =>$all['status'], 
            "next_run_date" => $nextRunDate->toDateString(), // Format as YYYY-MM-DD
        ]);

       
        if ($ins) {
            $message = ['status' => 1, 'message' => 'Recurring Expense Inserted Successfully.'];
        } else {
            $message = ['status' => 0, 'message' => 'Recurring Expense Insert Failed.'];
        }

        return response()->json($message);
    }





    public function edit($recurring_id)
    {
        $recurring = RecurringModel::find($recurring_id);
        $categories = CategoryModel::all();
        // return view('recurring.action.edit',['recurring'=> $recurring,'categories' => $categories]);
        return view('recurring.action.edit', compact('recurring', 'categories'));
    }


    public function update(Request $req)
    {

        //dd($req);
        $all = $req->all();
        $recurring = RecurringModel::find($all['recurring_id']);
        $recurring->category_id = $all['category_id'];
        $recurring->amount = $all['amount'];
        $recurring->frequency = $all['frequency'];
        $recurring->start_date = $all['start_date'];
        $recurring->end_date = $all['end_date'];
        $recurring->status = $all['status'];

        $upd = $recurring->save();

        if ($upd) {
            $message = ['status' => 1, 'message' => 'Edit Permission Success'];
        } else {
            $message = ['status' => 0, 'message' => 'Edit Permission Failed'];
        }
        return ($message);
    }



    public function destroy($recurring_id)
    {
        
        $recurring = RecurringModel::find($recurring_id);
        
        if ($recurring) {
            $recurring->delete();
            $message = ['status' => 1, 'message' => 'Delete Permission Success'];
        } else {
            $message = ['status' => 0, 'message' => 'Delete Permission Failed'];
        }
        return ($message);
    }



}
