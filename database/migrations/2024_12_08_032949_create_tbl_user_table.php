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
        if (!Schema::hasTable('tbl_user')) {
            Schema::create('tbl_user', function (Blueprint $table) {
                $table->id(); // AUTO_INCREMENT primary key
                $table->string('name', 200)->charset('utf8mb4')->collation('utf8mb4_general_ci'); // Name field
                $table->string('gender', 50)->charset('utf8mb4')->collation('utf8mb4_general_ci'); // Gender field
                $table->date('dob'); // Date of birth field
                $table->string('email', 100)->nullable()->charset('utf8mb4')->collation('utf8mb4_general_ci'); // Email field
                $table->string('phone', 20)->charset('utf8mb4')->collation('utf8mb4_general_ci'); // Phone number field
                $table->longText('password')->charset('utf8mb4')->collation('utf8mb4_general_ci'); // Password field
                $table->unsignedBigInteger('department_id'); // Foreign key for department
                $table->unsignedBigInteger('role_id');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_user');
    }
};
