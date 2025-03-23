<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CourseExam extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'course_id',
        'course_exam_title',
        'course_exam_description',
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function questions()
    {
        return $this->hasMany(CourseExamQuestion::class);
    }
}
