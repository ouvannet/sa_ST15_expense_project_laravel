<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;
use App\Models\RecurringModel;
use App\Models\ExpenseModel;

class ProcessRecurringExpenses extends Command
{
    protected $signature = 'expenses:process-recurring';

    protected $description = 'Process recurring expenses and create new expenses if due';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $today = Carbon::today();
        $recurringExpenses = RecurringModel::where('status', 'active')
            ->whereDate('next_run_date', '<=', $today)
            ->get();

        foreach ($recurringExpenses as $recurring) {
            // Create a new expense entry
            ExpenseModel::create([
                'category_id' => $recurring->category_id,
                'user_id' => $recurring->user_id,
                'amount' => $recurring->amount,
                'date' => $today,
                'description' => 'Recurring expense',
                'status' => 'active'
            ]);

            // Update the next run date based on the frequency
            switch ($recurring->frequency) {
                case 'daily':
                    $recurring->next_run_date = $today->addDay();
                    break;
                case 'weekly':
                    $recurring->next_run_date = $today->addWeek();
                    break;
                case 'monthly':
                    $recurring->next_run_date = $today->addMonth();
                    break;
                case 'yearly':
                    $recurring->next_run_date = $today->addYear();
                    break;
            }

            $recurring->save();
        }

        $this->info('Recurring expenses processed successfully.');
    }
}

