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
        Schema::create('transaction_courses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('course_id')->constrained(table: 'courses')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('user_id')->constrained(table: 'users')->cascadeOnDelete()->cascadeOnUpdate();
            $table->integer('total_payment');
            $table->boolean('status')->default(false);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaction_courses');
    }
};
