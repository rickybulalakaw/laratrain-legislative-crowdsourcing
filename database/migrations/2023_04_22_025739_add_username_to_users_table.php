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
        Schema::table('users', function (Blueprint $table) {
            $table->string('middlename')->nullable() ;
            $table->string('lastname');
            $table->string('extension')->nullable();
            $table->boolean('is_lgu_employee')->default(False);
            $table->boolean('is_sb_member')->default(False);
            $table->boolean('is_admin')->default(False);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};
