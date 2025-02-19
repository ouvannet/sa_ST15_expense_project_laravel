<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (!Schema::hasTable('tbl_recurring_expense')) {
            // Schema::create('tbl_recurring_expense', function (Blueprint $table) {
            //     $table->id(); // AUTO_INCREMENT primary key
            //     $table->unsignedBigInteger('expense_id'); // Foreign key placeholder
            //     $table->timestamp('date', 6)->useCurrent(); // Timestamp with microseconds, defaulting to current timestamp
            //     $table->string('type', 20)
            //           ->charset('utf8mb4')
            //           ->collation('utf8mb4_general_ci')
            //           ->default('month')
            //           ->comment('day,month,year'); // Type field with default value and comment
            //     $table->integer('interval_time')->default(1);

             
            // });

            Schema::create('tbl_recurring_expense', function (Blueprint $table) {
                $table->id();
                // $table->foreignId('expense_id')->constrained('tbl_expense')->onDelete('cascade');
                // $table->foreignId('user_id')->constrained('tbl_user')->onDelete('cascade');
                $table->foreignId('category_id')->constrained('tbl_categories')->onDelete('cascade');
                $table->foreignId('user_id')->constrained('tbl_user')->onDelete('cascade');
                $table->decimal('amount', 10, 2);
                $table->enum('frequency', ['daily', 'weekly', 'monthly', 'yearly']);
                $table->date('next_run_date');
                $table->date('start_date')->after('expense_id'); // Start date of recurrence
                $table->date('end_date')->nullable()->after('start_date'); // Nullable end date
                $table->enum('status', ['active', 'inactive'])->default('active')->after('end_date'); // Status of recurrence
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_recurring_expense');
    }
};
