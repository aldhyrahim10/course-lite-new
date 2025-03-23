<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CourseExamResult extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'course_id',
        'student_user_id',
        'course_exam_point',
        'is_passed',
    ];

    public function course() {
        return $this->belongsTo(Course::class);
    }

    public function student() {
        return $this->belongsTo(User::class);
    }
}
