<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CourseExamQuestion extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'course_exam_id',
        'course_exam_question_description',
    ];

    public function exam()
    {
        return $this->belongsTo(CourseExam::class);
    }

    public function answers()
    {
        return $this->hasMany(CourseExamAnswer::class);
    }
}
