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
        if (!Schema::hasTable('tbl_expense')){
            Schema::create('tbl_expense', function (Blueprint $table) {
                $table->id(); // AUTO_INCREMENT primary key
                $table->unsignedBigInteger('categories_id'); // Foreign key placeholder (unsigned integer)
                $table->unsignedBigInteger('user_id'); // Foreign key placeholder (unsigned integer)
                $table->integer('buget'); // Integer column for budget
                $table->integer('buget_balance'); // Integer column for budget balance
                $table->longText('description')->nullable()->charset('utf8mb4')->collation('utf8mb4_general_ci'); // Long text with character set and collation
                $table->string('attachment', 200)->nullable()->charset('utf8mb4')->collation('utf8mb4_general_ci'); // Attachment file path
                $table->string('status', 100)->charset('utf8mb4')->collation('utf8mb4_general_ci'); // Status field
                $table->unsignedInteger('assign')->nullable(); // Integer field for assignment
                $table->timestamp('date', 6)->useCurrent(); 
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_expense');
    }
};
