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
        if (!Schema::hasTable('tbl_expense_payment')){
            Schema::create('tbl_expense_payment', function (Blueprint $table) {
                $table->id(); // AUTO_INCREMENT primary key
                $table->unsignedBigInteger('expense_id'); // Foreign key placeholder (unsigned integer)
                $table->decimal('amout', 15, 2); // Decimal column for amount with precision 15 and scale 2
                $table->longText('note')->nullable()->charset('utf8mb4')->collation('utf8mb4_general_ci'); // Long text for note
                $table->timestamp('date', 6)->useCurrent();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_expense_payment');
    }
};
