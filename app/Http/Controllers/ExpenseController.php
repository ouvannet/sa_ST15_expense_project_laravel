<?php

namespace App\Http\Controllers;


use App\Models\ExpenseUsageModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\ExpenseModel;
use App\Models\CategoryModel;
use App\Models\UserModel;
use App\Models\RecurringModel;
use Illuminate\Support\Facades\Storage;
use App\Models\ReferenceModel;
use Barryvdh\DomPDF\Facade\Pdf;

use App\Helpers\TelegramHelper;

class ExpenseController extends Controller
{
    public function index()
    {
        $expenses = ExpenseModel::with(['category', 'requester', 'approver'])->get();
        $categories = CategoryModel::all();
        $users = UserModel::all();
        $recurring_expenses = RecurringModel::all();

        return view('expense.index', compact('expenses', 'categories', 'users', 'recurring_expenses'));

    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:Pending,Approved,Canceled',
        ]);

        $expense = ExpenseModel::findOrFail($id);
        $expense->status = $request->status;
        $expense->save();

        return response()->json(['success' => true, 'message' => 'Status updated successfully']);
    }



    public function add()
    {
        $expenses = ExpenseModel::with(['category', 'requester', 'approver'])->get();
        $categories = CategoryModel::all();
        $users = UserModel::all();
        $recurring_expenses = RecurringModel::all();
        return view('expense.action.add', compact('expenses', 'categories', 'users', 'recurring_expenses'));
    }


    // public function submit_add(Request $request)
    // {
    //     // Validate the request
    //     $request->validate([
    //         'categories_id' => 'required|integer',
    //         'user_id' => 'required|integer',
    //         'budget' => 'required|numeric',
    //         'description' => 'nullable|string|max:255',
    //         'attachment' => 'required|file|max:10240',
    //         'status' => 'required|string|max:50',
    //         'assign' => 'required|string|max:100',
    //         'date' => 'required|date',
    //     ]);

    //     // Fetch the reference number
    //     $reference = DB::table('tbl_reference')->where('type', 'expense')->first();
    //     if (!$reference) {
    //         return response()->json(['success' => false, 'message' => 'Reference type not found!'], 400);
    //     }

    //     // Handle file upload
    //     $path = $request->file('attachment')->store('uploads', 'public');

    //     // Set budget_balance to be the same as budget
    //     $data = $request->all();
    //     $data['budget_balance'] = $request->input('budget'); // Set budget_balance = budget

    //     // Create the expense record
    //     $formattedReference = sprintf('EXP%04d', $reference->value);
    //     $expense = ExpenseModel::create(array_merge($data, [
    //         'reference_number' => $formattedReference,
    //         'attachment' => $path,
    //     ]));

    //     // Increment the reference value
    //     DB::table('tbl_reference')->where('type', 'expense')->increment('value');


    //         DB::table('tbl_reference')->where('type', 'expense')->increment('value');

    //         // $message = "🔔 *New Expense Alert!*\n"
    //         //     . "━━━━━━━━━━━━━━━━━━━━━\n"
    //         //     . "💰 *Budget:* `{$expense->budget} USD`\n"
    //         //     . "📂 *Category:* `{$expense->category->name}`\n"
    //         //     . "📝 *Description:* `{$expense->description}`\n"
    //         //     . "📅 *Date:* `{$expense->date}`\n"
    //         //     . "📌 *Status:* `{$expense->status}`\n"
    //         //     . "━━━━━━━━━━━━━━━━━━━━━\n"
    //         //     . "🔗 [View Expense Details](Open Website){$expense->id})";

    //         // TelegramHelper::sendMessage($message);


    //     // Return response
    //     return response()->json([
    //         'status' => $expense ? 1 : 0,
    //         'message' => $expense ? 'Expense Inserted Successfully' : 'Expense Inserted Failed'
    //     ]);
    // }



    public function submit_add(Request $request)
    {
        // Validate the request
        $request->validate([
            'categories_id' => 'required|integer',
            'user_id' => 'required|integer',
            'budget' => 'required|numeric',
            'description' => 'nullable|string|max:255',
            'attachment' => 'required|file|max:10240',
            'status' => 'required|string|max:50',
            'assign' => 'required|string|max:100',
            'date' => 'required|date',
        ]);

        // Fetch the reference number
        $reference = DB::table('tbl_reference')->where('type', 'expense')->first();
        if (!$reference) {
            return response()->json(['success' => false, 'message' => 'Reference type not found!'], 400);
        }

        // Handle file upload
        $path = $request->file('attachment')->store('uploads', 'public');

        // Set budget_balance to be the same as budget
        $data = $request->all();
        $data['budget_balance'] = $request->input('budget');

        // Create the expense record
        $formattedReference = sprintf('EXP%04d', $reference->value);
        $expense = ExpenseModel::create(array_merge($data, [
            'reference_number' => $formattedReference,
            'attachment' => $path,
        ]));

        // Increment the reference value
        DB::table('tbl_reference')->where('type', 'expense')->increment('value');

        // Prepare the Telegram message
        $message = "🔔 <b>New Expense Alert!</b>\n"
            . "━━━━━━━━━━━━━━━━━━━━━\n"
            . "💰 <b>Budget:</b> <code>{$expense->budget} USD</code>\n"
            . "📂 <b>Category:</b> <code>{$expense->category->name}</code>\n"
            . "📝 <b>Description:</b> <code>{$expense->description}</code>\n"
            . "📅 <b>Date:</b> <code>{$expense->date}</code>\n"
            . "📌 <b>Status:</b> <code>{$expense->status}</code>\n"
            . "━━━━━━━━━━━━━━━━━━━━━\n"
            . "🔗 <a href='Open Website{$expense->id}'>View Expense Details</a>";

        // Send the message to the main chat and expense management group
        TelegramHelper::sendMessageToGroups($message, [
            env('TELEGRAM_CHAT_ID'),
            env('TELEGRAM_GROUP_EXPENSE_MANAGEMENT'),
        ]);

        // Send the photo to the main chat
        TelegramHelper::sendPhoto($path, "Attachment for Expense #{$formattedReference}");


        // Return response
        return response()->json([
            'status' => $expense ? 1 : 0,
            'message' => $expense ? 'Expense Inserted Successfully' : 'Expense Inserted Failed'
        ]);
    }


    public function useBalance(Request $request, $id)
    {
        $expense = ExpenseModel::findOrFail($id);

        $request->validate([
            'amount' => 'required|numeric|min:1|max:' . $expense->budget_balance,
            'payment_method' => 'required|string|max:50',
        ]);

        // Fetch reference value
        $reference = DB::table('tbl_reference')->where('type', 'payment')->first();

        if (!$reference) {
            return response()->json(['success' => false, 'message' => 'Reference type not found!'], 400);
        }

        $formattedReference = sprintf('PAY%04d', $reference->value);


        // Deduct the amount
        $expense->budget_balance -= $request->amount;
        if ($expense->budget_balance == 0) {
            $expense->status = 'Completed';
        }
        $expense->save();

        // Insert into tbl_expense_usage
        $inserted = DB::table('tbl_expense_usage')->insert([
            'expense_id' => $expense->id,
            'amount' => $request->amount,
            'used_at' => now(),
            'expense_reference_number' => $expense->reference_number,
            'reference_number' => $formattedReference,
            'payment_method' => $request->payment_method,
        ]);

        // Increment reference value
        DB::table('tbl_reference')->where('type', 'payment')->increment('value');

        if ($inserted) {
            return redirect()->route('expense.show', ['id' => $id])->with('success', 'Balance used successfully!');
        } else {
            return redirect()->route('expense.show', ['id' => $id])->withErrors(['error' => 'Failed to insert into expense usage.']);
        }

    }




    public function edit($expense_id)
    {
        $expense = ExpenseModel::find($expense_id);
        $categories = CategoryModel::all();
        $users = UserModel::all();
        $recurring_expenses = RecurringModel::all();

        return view('expense.action.edit', compact('expense', 'categories', 'users', 'recurring_expenses'));
    }


    // public function update(Request $req)
    // {
    //     $all = $req->all();
    //     $expense = ExpenseModel::find($all['expense_id']);

    //     $expense->categories_id = $all['category_id'];
    //     $expense->user_id = $all['user_id'];
    //     $expense->budget = $all['budget'];
    //     $expense->budget_balance = $all['budget'];
    //     $expense->description = $all['description'];
    //     $expense->attachment = $all['attachment'];
    //     $expense->status = $all['status'];
    //     $expense->assign = $all['assigned_to'];
    //     $expense->date = $all['date'];



    //     $upd = $expense->save();

    //     if ($upd) {
    //         $message = ['status' => 1, 'message' => 'Expense Update Successfully'];
    //     } else {
    //         $message = ['status' => 0, 'message' => 'Exepse Update Failed'];
    //     }
    //     return ($message);

    // }
    public function update(Request $req)
    {
        $all = $req->all();
        $expense = ExpenseModel::find($all['expense_id']);

        if (!$expense) {
            return response()->json(['status' => 0, 'message' => 'Expense not found'], 404);
        }

        $expense->categories_id = $all['category_id'];
        $expense->user_id = $all['user_id'];
        $expense->budget = $all['budget'];
        $expense->budget_balance = $all['budget'];
        $expense->description = $all['description'];
        $expense->status = $all['status'];
        $expense->assign = $all['assigned_to'];
        $expense->date = $all['date'];

        // Check if an attachment is provided
        if ($req->hasFile('attachment')) {
            $file = $req->file('attachment');
            $filename = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('attachments', $filename, 'public');

            $expense->attachment = $filePath;
        }

        $upd = $expense->save();

        if ($upd) {
            return response()->json(['status' => 1, 'message' => 'Expense updated successfully']);
        } else {
            return response()->json(['status' => 0, 'message' => 'Expense update failed']);
        }
    }






    public function destroy($expense_id)
    {
        $expense = ExpenseModel::find($expense_id);

        if ($expense) {
            // Delete the associated file from storage if it exists
            if ($expense->attachment && Storage::disk('public')->exists($expense->attachment)) {
                Storage::disk('public')->delete($expense->attachment);
            }

            // Delete the expense record from the database
            $expense->delete();

            $message = ['status' => 1, 'message' => 'Expense Deleted Successfully'];
        } else {
            $message = ['status' => 0, 'message' => 'Expense Not Found'];
        }

        return response()->json($message); // Return as JSON for consistency with AJAX
    }


    public function showUseBalance($id)
    {
        $expense = ExpenseModel::with(['category', 'user', 'usages'])->findOrFail($id);
        return view('expense.showUseBalance', compact('expense'));
    }


    public function preview($id)
    {
        // Retrieve the expense and related data
        $expense = ExpenseModel::with('category', 'requester', 'approver', 'usages')->findOrFail($id);

        if (!$expense) {
            return response()->json(['error' => 'Expense not found'], 404);
        }
        // Data to be passed to the view
        $data = [
            'reference_number' => $expense->reference_number,
            'category_name' => $expense->category->name ?? 'N/A',
            'user_name' => $expense->requester->name ?? 'N/A',
            'assign_name' => $expense->approver->name ?? 'N/A',
            'budget' => $expense->budget,
            'budget_balance' => $expense->budget_balance,
            'usages' => $expense->usages, // Pass the related usages
            'description' => $expense->description,
            'status' => $expense->status,
            'date' => \Carbon\Carbon::parse($expense->date)->format('Y-m-d'),
            'attachment' => $expense->attachment,

        ];

        return response()->json(['html' => view('expense.invoice', $data)->render()]);

    }



}



