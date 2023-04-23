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
        Schema::create('bills', function (Blueprint $table) {
            $table->id();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable();
            $table->string('title');
            $table->string('bill_no');
            $table->string('year');
            $table->text('summary');
            $table->foreignId('user_id')->default(1)->constrained()->onDelete('cascade');
            $table->string('status')->default('bill');

            
            // $table->string('file_upload');
            // $table->integer('sb_sponsor');
            // $table->integer('committee_sponsor');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bills');
    }
};
