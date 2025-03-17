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
        Schema::create('course_exam_answers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('course_exam_question_id')->constrained(table: 'course_exam_questions')->cascadeOnDelete()->cascadeOnUpdate();
            $table->text('course_exam_answer_description');
            $table->boolean('is_true')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('course_exam_answers');
    }
};
