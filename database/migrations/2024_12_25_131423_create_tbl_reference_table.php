<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('tbl_reference', function (Blueprint $table) {
            $table->id(); // `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT
            $table->string('type', 20); // `type` varchar(20) NOT NULL
            $table->bigInteger('value'); // `value` bigint(20) NOT NULL
            $table->timestamps(); // `created_at` and `updated_at` with default CURRENT_TIMESTAMP
            $table->index('type', 'expense_id'); // KEY `expense_id` (`type`)
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
