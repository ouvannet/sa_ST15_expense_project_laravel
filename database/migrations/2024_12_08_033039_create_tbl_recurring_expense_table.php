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
            Schema::create('tbl_recurring_expense', function (Blueprint $table) {
                $table->id(); // AUTO_INCREMENT primary key
                $table->unsignedBigInteger('expense_id'); // Foreign key placeholder
                $table->timestamp('date', 6)->useCurrent(); // Timestamp with microseconds, defaulting to current timestamp
                $table->string('type', 20)
                      ->charset('utf8mb4')
                      ->collation('utf8mb4_general_ci')
                      ->default('month')
                      ->comment('day,month,year'); // Type field with default value and comment
                $table->integer('interval_time')->default(1);
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
