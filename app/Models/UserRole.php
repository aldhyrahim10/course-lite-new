<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserRole extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_role_name',
    ];

    public function users()
    {
        return $this->hasMany(User::class, 'user_role_id', 'id');
    }
}
