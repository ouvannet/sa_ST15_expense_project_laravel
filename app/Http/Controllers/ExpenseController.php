<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ExpenseModel;

class ExpenseController extends Controller
{
    public function index()
    {
        $expenses = ExpenseModel::all();
        return view('expense.index', compact('expenses'));
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
        return view('expense.edit', compact('expenses'));
    }


    // public function update(Request $request, $id)
    // {
    //     $request->validate([
    //         'categories_id' => 'required|integer',
    //         'user_id' => 'required|integer',
    //         'budget' => 'required|numeric',
    //         'budget_balance' => 'required|numeric',
    //         'description' => 'nullable|string|max:255',
    //         'attachment' => 'nullable|string',
    //         'status' => 'required|string|max:50',
    //         'assign' => 'required|string|max:100',
    //         'date' => 'required|date',
    //     ]);

    //     $expense = ExpenseModel::findOrFail($id);
    //     $expense->update($request->all());

    //     return response()->json(['success' => true, 'message' => 'Expense updated successfully!']);
    // }

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



