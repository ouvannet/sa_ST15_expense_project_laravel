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
       
        Schema::create('tbl_expense_payment', function (Blueprint $table) {
            $table->id(); // `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT
            $table->unsignedBigInteger('expense_id'); // `expense_id` bigint(20) unsigned NOT NULL
            $table->decimal('amout', 15, 2); // `amout` decimal(15,2) NOT NULL
            $table->longText('note')->nullable(); // `note` longtext COLLATE utf8mb4_unicode_ci
            $table->timestamp('date', 6)->default(DB::raw('CURRENT_TIMESTAMP(6)')); // `date` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6)

            $table->timestamps(); // Adds `created_at` and `updated_at` fields for consistency with Laravel conventions
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_expense_payment');
    }
};
