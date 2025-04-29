<?php
namespace App\Console\Commands;

use App\Models\RecurringModel;
use App\Http\Controllers\RecurringExpenseController;
use Illuminate\Console\Command;

class GenerateRecurringExpenses extends Command
{
    protected $signature = 'expenses:generate-recurring';
    protected $description = 'Generate expenses for active recurring expenses';

    public function handle()
    {
        $recurringExpenses = RecurringModel::where('status', 'active')
            ->whereNotNull('next_run_date')
            ->get();

        $controller = new RecurringExpenseController();

        foreach ($recurringExpenses as $recurringExpense) {
            $controller->generateExpenses($recurringExpense);
        }

        $this->info('Recurring expenses processed successfully.');
    }
}
