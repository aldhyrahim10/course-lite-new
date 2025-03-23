<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TransactionCourse extends Model
{
    use SoftDeletes;
    
    protected $fillable = ['user_id', 'course_id', 'total_payment', 'status'];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
