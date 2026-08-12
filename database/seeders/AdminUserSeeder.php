<?php
  
namespace Database\Seeders;
  
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
  
class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::firstOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'name' => 'Hardik',
                'phone' => '+91 98765 43210',
                'status' => 'active',
                'password' => bcrypt('123456'),
            ]
        );
    }
}