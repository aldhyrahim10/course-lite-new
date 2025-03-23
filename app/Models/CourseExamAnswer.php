<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CourseExamAnswer extends Model
{
    protected $fillable = [
        'course_exam_question_id',
        'course_exam_answer_description',
        'is_true',
    ];

    public function question()
    {
        return $this->belongsTo(CourseExamQuestion::class);
    }
}
