<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::firstOrCreate(
            [
                'email' => 'admin@gmail.com',
            ],
            [
                'name' => 'Hardik',
                'phone' => '+91 98765 43210',
                'status' => 'active',
                'password' => '123456',
            ]
        );
    }
}