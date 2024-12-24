<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\ExpenseModel;
use App\Models\CategoryModel;
use App\Models\UserModel;



class ExpenseController extends Controller
{
    public function index()
    {
        $expenses = DB::table('tbl_expense')
        ->join('tbl_categories', 'tbl_expense.categories_id', '=', 'tbl_categories.id')
        ->join('tbl_user', 'tbl_expense.user_id', '=', 'tbl_user.id')
        ->select(
            'tbl_expense.*',
            'tbl_categories.name as category_name',
            'tbl_user.name as user_name'
        )
        ->get();

        $categories = CategoryModel::all();
        $users = UserModel::all();

        return view('expense.index', compact('expenses','categories','users'));
    }

    public function add(Request $request)
    {
        $request->validate([
            'categories_id' => 'required|integer',
            'user_id' => 'required|integer',
            'budget' => 'required|numeric',
            'budget_balance' => 'required|numeric',
            'description' => 'nullable|string|max:255',
            'attachment' => 'nullable|string',
            'status' => 'required|string|max:50',
            'assign' => 'required|string|max:100',
            'date' => 'required|date',
        ]);

        ExpenseModel::create($request->all());
        return response()->json(['success' => true, 'message' => 'Expense added successfully!']);
    }

    public function edit($id)
    {
        $expenses = ExpenseModel::findOrFail($id);
        $categories = CategoryModel::all();
        return view('expense.edit', compact('expenses','categories'));
    }


    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'categories_id' => 'required|integer',
            'user_id' => 'required|integer',
            'budget' => 'required|numeric',
            'budget_balance' => 'required|numeric',
            'description' => 'nullable|string|max:255',
            'attachment' => 'nullable|string',
            'status' => 'required|string|max:50',
            'assign' => 'required|string|max:100',
            'date' => 'required|date',
        ]);

        $expense = ExpenseModel::findOrFail($id);
        $expense->update($validated);

        return response()->json(['message' => 'Expense updated successfully.']);
    }


    public function destroy($id)
    {
        $expense = ExpenseModel::findOrFail($id);
        $expense->delete();

        return response()->json(['success' => true, 'message' => 'Expense deleted successfully!']);
    }
}



