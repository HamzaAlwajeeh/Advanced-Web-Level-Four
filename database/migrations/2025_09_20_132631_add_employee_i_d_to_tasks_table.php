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
        Schema::table('Tasks', function (Blueprint $table) {
            $table->foreignId('employee_id')->nullable()->constrained('employees')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('Tasks', function (Blueprint $table) {
            $table->dropColumn('employee_id');
        });
    }
};
