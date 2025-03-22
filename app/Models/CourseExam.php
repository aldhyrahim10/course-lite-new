<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CourseExam extends Model
{
    protected $fillable = [
        'course_id',
        'course_exam_title',
        'course_exam_description',
        'course_total_question'
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
