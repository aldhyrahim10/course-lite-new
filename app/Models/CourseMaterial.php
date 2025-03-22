<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CourseMaterial extends Model
{
    protected $fillable = [
        'course_id',
        'course_material_title',
        'course_material_description',
        'course_material_modul',
        'course_material_video',
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
