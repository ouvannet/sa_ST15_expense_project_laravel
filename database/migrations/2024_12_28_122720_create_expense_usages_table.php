<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
       

        Schema::create('tbl_expense_usage', function (Blueprint $table) {
            $table->id(); // `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT
            $table->unsignedBigInteger('expense_id'); // `expense_id` bigint(20) unsigned NOT NULL
            $table->decimal('amount', 10, 2); // `amount` decimal(10,2) NOT NULL


            $table->foreign('expense_id')->references('id')->on('tbl_expenses')->onDelete('cascade');
            $table->timestamp('used_at')->nullable()->default(DB::raw('CURRENT_TIMESTAMP')); // `used_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
            $table->timestamps(); // `created_at` and `updated_at` with NULL defaults

            $table->index('expense_id', 'expense_id'); // KEY `expense_id` (`expense_id`)
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_expense_usage');
    }
};
