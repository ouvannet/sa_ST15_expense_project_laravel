<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\ExpenseModel;
use App\Models\CategoryModel;
use App\Models\UserModel;
use App\Models\ReferenceModel;


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


        return view('expense.index', compact('expenses', 'categories', 'users'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:Pending,Approved,Rejected',
        ]);

        $expense = ExpenseModel::findOrFail($id);
        $expense->status = $request->status;
        $expense->save();

        return response()->json(['success' => true, 'message' => 'Status updated successfully']);
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

        // Fetch the current value from tbl_reference where type = 'expense'
        $reference = DB::table('tbl_reference')->where('type', 'expense')->first();

        if (!$reference) {
            return response()->json(['success' => false, 'message' => 'Reference type not found!'], 400);
        }

        // Format the reference number as EXP0001, EXP0002, etc.
        $formattedReference = sprintf('EXP%04d', $reference->value);

        // Insert the new expense into tbl_expense
        $expense = ExpenseModel::create(array_merge($request->all(), [
            'reference_number' => $formattedReference,
        ]));

        // Increment the value in tbl_reference
        DB::table('tbl_reference')->where('type', 'expense')->increment('value');

        return response()->json(['success' => true, 'message' => 'Expense added successfully!', 'data' => $expense]);
    }

    public function edit($id)
    {
        $expenses = ExpenseModel::findOrFail($id);
        $categories = CategoryModel::all();
        return view('expense.edit', compact('expenses', 'categories'));
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

    public function showUseBalance($id)
    {
        $expense = ExpenseModel::with(['category', 'user', 'usages'])->findOrFail($id);
        return view('expense.showUseBalance', compact('expense'));
    }

    public function useBalance(Request $request, $id)
    {
        $expense = ExpenseModel::findOrFail($id);

        $request->validate([
            'amount' => 'required|numeric|min:1|max:' . $expense->budget_balance,
        ]);


        try {
            // Begin a transaction
            DB::beginTransaction();

            // Deduct the amount from the budget balance
            $expense->budget_balance -= $request->amount;
            $expense->save();

            // Log the usage in a new table (optional)
            DB::table('tbl_expense_usage')->insert([
                'expense_id' => $expense->id,
                'amount' => $request->amount,
                'used_at' => now(),
            ]);

            // Commit the transaction
            DB::commit();

            return redirect()->route('expense.show', ['id' => $id])->with('success', 'Balance used successfully!');
        } catch (\Exception $e) {
            // Rollback on error
            DB::rollBack();
            return redirect()->route('expense.show', ['id' => $id])->withErrors(['error' => $e->getMessage()]);
        }
    }
}



