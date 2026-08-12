<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            'Electronics',
            'Fashion',
            'Home & Living',
            'Sports',
            'Beauty',
            'Accessories',
        ];

        foreach ($categories as $category) {
            Category::firstOrCreate(['name' => $category], [
                'description' => $category . ' category',
            ]);
        }
    }
}
