<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'user_role_id',
        'name',
        'email',
        'password',
        'no_telp',
        'user_image'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function role()
    {
        return $this->belongsTo(UserRole::class, 'user_role_id', 'id');
    }

    public function hasRole($roleName)
    {
        return $this->role && $this->role->user_role_name === $roleName;
    }

    public function assignRole($role) {
        if (is_string($role)) {
            $role = UserRole::where('user_role_name', $role)->firstOrFail();
        }
        $this->role()->associate($role);
        $this->save();

        return $this;
    }

    public function removeRole() {
        $this->role()->dissociate();
        $this->save();

        return $this;
    }
}
