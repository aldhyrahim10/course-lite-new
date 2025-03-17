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
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('course_category_id')->constrained(table: 'course_categories')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('instructor_id')->constrained(table: 'users')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('course_name');
            $table->text('course_description');
            $table->text('course_benefit');
            $table->integer('course_price');
            $table->string('course_image');
            $table->boolean('is_discount')->default(false);
            $table->integer('discount_percentage');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
