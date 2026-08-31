<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        /*
         * Create sample users.
         */
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