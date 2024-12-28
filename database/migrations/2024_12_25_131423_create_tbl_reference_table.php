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
    Schema::create('tbl_reference', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('expense_id')->nullable();
        $table->string('reference_number')->unique();
        $table->timestamps();

        $table->foreign('expense_id')->references('id')->on('tbl_expense')->onDelete('cascade');
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_reference');
    }
};
