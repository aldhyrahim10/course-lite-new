<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CourseCategory extends Model
{
    protected $fillable = ['course_category_name'];

    public function course()
    {
        return $this->hasMany(Course::class, 'course_category_id', 'id');
    }
}
