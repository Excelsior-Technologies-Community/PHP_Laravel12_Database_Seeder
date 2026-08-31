<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
<<<<<<< HEAD

        
        User::factory()->create([
            'name' => 'Test User',
            'email' =>'test@example.com',

=======
        /*
         * Create sample users.
         */
>>>>>>> development
        User::factory(10)->create();

        /*
         * Create categories first because
         * ProductSeeder depends on categories.
         */
        $this->call([
            CategorySeeder::class,
            ProductSeeder::class,
            AdminUserSeeder::class,

        ]);
    }
}