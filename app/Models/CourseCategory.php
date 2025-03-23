<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CourseCategory extends Model
{
    use SoftDeletes;

    protected $fillable = ['course_category_name'];

    public function course()
    {
        return $this->hasMany(Course::class, 'course_category_id', 'id');
    }
}
