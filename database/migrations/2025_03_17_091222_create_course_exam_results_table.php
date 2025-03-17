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
        Schema::create('course_exam_results', function (Blueprint $table) {
            $table->id();
            $table->foreignId('course_id')->constrained(table: 'courses')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('student_user_id')->constrained(table: 'users')->cascadeOnDelete()->cascadeOnUpdate();
            $table->integer('course_exam_point');
            $table->boolean('is_passed')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('course_exam_results');
    }
};
