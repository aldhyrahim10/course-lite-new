<?php

namespace Database\Seeders;

use App\Models\UserRole;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            ['user_role_name' => 'administrator'],
            ['user_role_name' => 'instructor'],
            ['user_role_name' => 'student'],
        ];

        foreach ($roles as $role) {
            UserRole::create($role);
        }
    }
}
