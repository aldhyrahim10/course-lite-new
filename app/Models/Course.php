<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Course extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'course_name',
        'course_category_id',
        'course_price',
        'course_description',
        'course_image',
        'course_benefit',
        'is_discount',
        'discount_percentage',
        'instructor_id',
    ];

    public function courseCategory()
    {
        return $this->belongsTo(CourseCategory::class, 'course_category_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'instructor_id', 'id');
    }

    public function courseMaterial()
    {
        return $this->hasMany(CourseMaterial::class);
    }

    public function courseExam()
    {
        return $this->hasMany(CourseExam::class);
    }
}
