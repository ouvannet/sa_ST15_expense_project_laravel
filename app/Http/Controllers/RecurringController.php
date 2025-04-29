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



// namespace App\Http\Controllers;

// use App\Models\RecurringModel;
// use App\Models\ExpenseModel;
// use App\Models\CategoryModel;
// use Carbon\Carbon;
// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\DB;

// class RecurringController extends Controller
// {
//     public function index()
//     {
//         $recurring_expense = RecurringModel::with(['expense', 'category', 'user'])->get();
//         $categories = CategoryModel::all();
//         $expenses = ExpenseModel::all(); // Fetch all expenses using the model
//         return view('recurring.index', compact('recurring_expense', 'categories', 'expenses'));
//     }

//     public function add()
//     {
//         $categories = CategoryModel::all();
//         $expenses = ExpenseModel::select('id', 'reference_number', 'budget', 'status', 'categories_id', 'user_id')->get();
//         return view('recurring.action.add', compact('categories', 'expenses'));
//     }

//     public function submit_add(Request $req)
//     {
//         $all = $req->validate([
//             'expense_id' => 'required|exists:tbl_expense,id',
//             'frequency' => 'required|in:daily,weekly,monthly,yearly',
//             'start_date' => 'required|date',
//             'end_date' => 'required|date|after_or_equal:start_date',
//             'status' => 'required|in:active,inactive,canceled',
//         ]);

//         $expense = ExpenseModel::find($req->expense_id);
//         if (!$expense) {
//             return response()->json(['status' => 0, 'message' => 'Expense not found']);
//         }

//         $startDate = Carbon::parse($all['start_date']);
//         $nextRunDate = $startDate->copy();

//         // Create recurring expense using expense's user_id, category_id, and budget
//         $recurring = RecurringModel::create([
//             'category_id' => $expense->categories_id,
//             'user_id' => $expense->user_id,
//             'amount' => $expense->budget,
//             'frequency' => $all['frequency'],
//             'start_date' => $all['start_date'],
//             'end_date' => $all['end_date'],
//             'status' => $all['status'],
//             'next_run_date' => $nextRunDate->toDateString(),
//         ]);

//         // Generate initial expense if active
//         if ($recurring->status === 'active') {
//             $this->generateExpense($recurring);
//         }


//         return response()->json([
//             'status' => 1,
//             'message' => 'Recurring Expense Inserted Successfully.',
//         ]);
//     }


//     public function edit($recurring_id)
//     {
//         $recurring = RecurringModel::find($recurring_id);
//         $categories = CategoryModel::all();
//         if (!$recurring) {
//             return redirect()->route('recurring.index')->with('error', 'Recurring expense not found.');
//         }
//         return view('recurring.action.edit', compact('recurring', 'categories'));
//     }

//     public function update(Request $req)
//     {
//         $all = $req->validate([
//             'recurring_id' => 'required|exists:tbl_recurring_expense,id',
//             'category_id' => 'required|exists:categories,id',
//             'amount' => 'required|numeric|min:0',
//             'frequency' => 'required|in:daily,weekly,monthly,yearly',
//             'start_date' => 'required|date',
//             'end_date' => 'required|date|after_or_equal:start_date',
//             'status' => 'required|in:active,inactive,canceled',
//         ]);

//         $recurring = RecurringModel::find($all['recurring_id']);
//         if (!$recurring) {
//             return response()->json(['status' => 0, 'message' => 'Recurring expense not found']);
//         }

//         // Update next_run_date if frequency or start_date changed
//         $startDate = Carbon::parse($all['start_date']);
//         $nextRunDate = $startDate->copy();

//         $recurring->update([
//             'category_id' => $all['category_id'],
//             'amount' => $all['amount'],
//             'frequency' => $all['frequency'],
//             'start_date' => $all['start_date'],
//             'end_date' => $all['end_date'],
//             'status' => $all['status'],
//             'next_run_date' => $nextRunDate->toDateString(),
//         ]);

//         // Regenerate expense if active
//         if ($recurring->status === 'active') {
//             // Optionally delete future expenses and regenerate
//             ExpenseModel::where('recurring_expense_id', $recurring->id)
//                 ->where('date', '>=', Carbon::today())
//                 ->delete();
//             $this->generateExpense($recurring);
//         }

//         return response()->json([
//             'status' => 1,
//             'message' => 'Recurring Expense Updated Successfully',
//         ]);
//     }

//     public function destroy($recurring_id)
//     {
//         $recurring = RecurringModel::find($recurring_id);
//         if ($recurring) {
//             // Optionally delete associated expenses
//             ExpenseModel::where('recurring_expense_id', $recurring_id)->delete();
//             $recurring->delete();
//             return response()->json([
//                 'status' => 1,
//                 'message' => 'Recurring Expense Deleted Successfully',
//             ]);
//         }
//         return response()->json([
//             'status' => 0,
//             'message' => 'Recurring Expense Not Found',
//         ]);
//     }

//     protected function generateExpense(RecurringModel $recurring)
//     {
//         $currentDate = Carbon::parse($recurring->next_run_date);
//         $endDate = Carbon::parse($recurring->end_date);

//         if ($currentDate > $endDate || $recurring->status !== 'active') {
//             return;
//         }

//         // Generate expense
//         ExpenseModel::create([
//             'reference_number' => 'REC-' . $recurring->id . '-' . $currentDate->format('Ymd'),
//             'category_id' => $recurring->category_id,
//             'user_id' => $recurring->user_id,
//             'budget' => $recurring->amount,
//             'budget_balance' => $recurring->amount,
//             'status' => 'Pending',
//             'date' => $currentDate->toDateString(),
//             'recurring_expense_id' => $recurring->id,
//         ]);

//         // Update next_run_date
//         switch ($recurring->frequency) {
//             case 'daily':
//                 $nextRunDate = $currentDate->addDay();
//                 break;
//             case 'weekly':
//                 $nextRunDate = $currentDate->addWeek();
//                 break;
//             case 'monthly':
//                 $nextRunDate = $currentDate->addMonth();
//                 break;
//             case 'yearly':
//                 $nextRunDate = $currentDate->addYear();
//                 break;
//             default:
//                 $nextRunDate = $currentDate;
//                 break;
//         }

//         // Update next_run_date or deactivate if past end_date
//         if ($nextRunDate <= $endDate) {
//             $recurring->update(['next_run_date' => $nextRunDate->toDateString()]);
//         } else {
//             $recurring->update(['status' => 'inactive', 'next_run_date' => null]);
//         }
//     }
// }
