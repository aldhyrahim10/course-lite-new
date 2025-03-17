<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'user_role_id' => 1,
                'name' => 'User 1',
                'email' => 'tes1@gmail.com',
                'password' => bcrypt('user1234'),
                'no_telp' => '08123782372',
                'user_image' => '-'
            ],
            [
                'user_role_id' => 2,
                'name' => 'User 2',
                'email' => 'tes2@gmail.com',
                'password' => bcrypt('user1234'),
                'no_telp' => '08123782372',
                'user_image' => '-'
            ],
            [
                'user_role_id' => 3,
                'name' => 'User 3',
                'email' => 'tes3@gmail.com',
                'password' => bcrypt('user1234'),
                'no_telp' => '08123782372',
                'user_image' => '-'
            ]
        ];

            foreach ($users as $user) {
                User::create($user);
            }
    }
}
