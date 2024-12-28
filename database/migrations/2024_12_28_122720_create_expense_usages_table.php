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
        Schema::create('expense_usages', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('expense_id');
            $table->decimal('amount', 10, 2);
            $table->timestamp('used_at');
            $table->foreign('expense_id')->references('id')->on('tbl_expense')->onDelete('cascade');
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('expense_usages');
    }
};
