<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
    protected $fillable = [
        'user_role_name',
    ];

    public function users()
    {
        return $this->hasMany(User::class, 'user_role_id', 'id');
    }
}
