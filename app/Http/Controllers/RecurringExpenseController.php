<?php

namespace App\Http\Controllers;

use App\Models\ExpenseModel;
use App\Models\RecurringModel;
use Carbon\Carbon;
use Illuminate\Http\Request;

class RecurringExpenseController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'expense_id' => 'required|exists:expenses,id',
            'user_id' => 'required|exists:users,id',
            'category_id' => 'required|exists:categories,id',
            'amount' => 'required|numeric|min:0',
            'frequency' => 'required|in:daily,weekly,monthly,yearly',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'status' => 'required|in:active,inactive,canceled',
        ]);

        // Set next_run_date to start_date initially
        $validated['next_run_date'] = $validated['start_date'];

        $recurringExpense = RecurringModel::create($validated);

        // Generate initial expense records
        $this->generateExpenses($recurringExpense);

        return response()->json(['message' => 'Recurring expense created successfully']);
    }

    public function generateExpenses(RecurringModel $recurringExpense)
    {
        $startDate = Carbon::parse($recurringExpense->start_date);
        $endDate = Carbon::parse($recurringExpense->end_date);
        $currentDate = Carbon::parse($recurringExpense->next_run_date);

        if ($currentDate > $endDate || $recurringExpense->status !== 'active') {
            return;
        }

        
        // Generate expense for the current next_run_date
        ExpenseModel::create([
            'reference_number' => 'REC-' . $recurringExpense->id . '-' . $currentDate->format('Ymd'),
            'category_id' => $recurringExpense->category_id,
            'user_id' => $recurringExpense->user_id,
            'budget' => $recurringExpense->amount,
            'budget_balance' => $recurringExpense->amount,
            'status' => 'Pending',
            'date' => $currentDate->toDateString(),
            'recurring_expense_id' => $recurringExpense->id,
        ]);

        // Update next_run_date based on frequency
        switch ($recurringExpense->frequency) {
            case 'daily':
                $nextRunDate = $currentDate->addDay();
                break;
            case 'weekly':
                $nextRunDate = $currentDate->addWeek();
                break;
            case 'monthly':
                $nextRunDate = $currentDate->addMonth();
                break;
            case 'yearly':
                $nextRunDate = $currentDate->addYear();
                break;
            default:
                $nextRunDate = $currentDate;
        }

        // Update next_run_date if within end_date
        if ($nextRunDate <= $endDate) {
            $recurringExpense->update(['next_run_date' => $nextRunDate]);
        } else {
            $recurringExpense->update(['status' => 'inactive', 'next_run_date' => null]);
        }
    }
}