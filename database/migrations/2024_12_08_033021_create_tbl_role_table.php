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
        if (!Schema::hasTable('tbl_role')) {
            Schema::create('tbl_role', function (Blueprint $table) {
                $table->id(); // AUTO_INCREMENT primary key
                $table->string('name', 100)
                      ->charset('utf8mb4')
                      ->collation('utf8mb4_general_ci'); 
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_role');
    }
};
