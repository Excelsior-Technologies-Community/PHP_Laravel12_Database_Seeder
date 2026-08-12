<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $categories = Category::all()->keyBy('name');

        $products = [
            ['name' => 'Smart Watch Pro', 'category' => 'Electronics', 'price' => 2999.00, 'stock' => 25, 'featured' => true, 'status' => 'active', 'image' => 'https://images.unsplash.com/photo-1523275335684-37898b6baf30?auto=format&fit=crop&w=900&q=80', 'description' => 'Premium smartwatch with fitness tracking.'],
            ['name' => 'Wireless Earbuds', 'category' => 'Electronics', 'price' => 1899.00, 'stock' => 30, 'featured' => true, 'status' => 'active', 'image' => 'https://images.unsplash.com/photo-1546435770-a3e426bf472b?auto=format&fit=crop&w=900&q=80', 'description' => 'Clear sound and wireless freedom.'],
            ['name' => 'Running Shoes', 'category' => 'Fashion', 'price' => 2499.00, 'stock' => 18, 'featured' => true, 'status' => 'active', 'image' => 'https://images.unsplash.com/photo-1542291026-7eec264c27ff?auto=format&fit=crop&w=900&q=80', 'description' => 'Comfortable run-ready footwear.'],
            ['name' => 'Urban Backpack', 'category' => 'Accessories', 'price' => 1599.00, 'stock' => 40, 'featured' => false, 'status' => 'active', 'image' => 'https://images.unsplash.com/photo-1584917865442-de89df76afd3?auto=format&fit=crop&w=900&q=80', 'description' => 'Spacious business backpack.'],
            ['name' => 'Coffee Maker', 'category' => 'Home & Living', 'price' => 3499.00, 'stock' => 14, 'featured' => true, 'status' => 'active', 'image' => 'https://images.unsplash.com/photo-1495474472287-4d71bcdd2085?auto=format&fit=crop&w=900&q=80', 'description' => 'Fresh coffee at home every day.'],
            ['name' => 'Laptop Stand', 'category' => 'Electronics', 'price' => 1299.00, 'stock' => 22, 'featured' => false, 'status' => 'active', 'image' => 'https://images.unsplash.com/photo-1517336714731-489689fd1ca8?auto=format&fit=crop&w=900&q=80', 'description' => 'Ergonomic stand for productivity.'],
            ['name' => 'Bluetooth Speaker', 'category' => 'Electronics', 'price' => 2199.00, 'stock' => 27, 'featured' => true, 'status' => 'active', 'image' => 'https://images.unsplash.com/photo-1518444065439-e933c06ce9cd?auto=format&fit=crop&w=900&q=80', 'description' => 'Portable sound with deep bass.'],
            ['name' => 'Gaming Mouse', 'category' => 'Accessories', 'price' => 999.00, 'stock' => 35, 'featured' => false, 'status' => 'active', 'image' => 'https://images.unsplash.com/photo-1615663245857-ac93bb7c39e7?auto=format&fit=crop&w=900&q=80', 'description' => 'High precision gaming experience.'],
            ['name' => 'Office Chair', 'category' => 'Home & Living', 'price' => 4599.00, 'stock' => 12, 'featured' => true, 'status' => 'active', 'image' => 'https://images.unsplash.com/photo-1505693416388-ac5ce068fe85?auto=format&fit=crop&w=900&q=80', 'description' => 'Comfortable seating for work.'],
            ['name' => 'DSLR Camera', 'category' => 'Electronics', 'price' => 8999.00, 'stock' => 10, 'featured' => true, 'status' => 'active', 'image' => 'https://images.unsplash.com/photo-1516035069371-29a1b244cc32?auto=format&fit=crop&w=900&q=80', 'description' => 'Capture sharp photographs.'],
            ['name' => 'Mobile Tripod', 'category' => 'Accessories', 'price' => 799.00, 'stock' => 50, 'featured' => false, 'status' => 'active', 'image' => 'https://images.unsplash.com/photo-1526170375885-4d8ecf77b99f?auto=format&fit=crop&w=900&q=80', 'description' => 'Stable support for mobile content.'],
            ['name' => 'Fitness Band', 'category' => 'Sports', 'price' => 1499.00, 'stock' => 26, 'featured' => false, 'status' => 'active', 'image' => 'https://images.unsplash.com/photo-1576243340885-8c9f7a5625d2?auto=format&fit=crop&w=900&q=80', 'description' => 'Track activity and health metrics.'],
            ['name' => 'Classic Hoodie', 'category' => 'Fashion', 'price' => 1299.00, 'stock' => 32, 'featured' => true, 'status' => 'active', 'image' => 'https://images.unsplash.com/photo-1521572267360-ee0c2909d518?auto=format&fit=crop&w=900&q=80', 'description' => 'Soft casual wear for daily comfort.'],
            ['name' => 'Travel Bag', 'category' => 'Accessories', 'price' => 1999.00, 'stock' => 21, 'featured' => false, 'status' => 'active', 'image' => 'https://images.unsplash.com/photo-1525966222134-fcfa99b8ae77?auto=format&fit=crop&w=900&q=80', 'description' => 'Compact and durable luggage.'],
            ['name' => 'Home Lamp', 'category' => 'Home & Living', 'price' => 1799.00, 'stock' => 19, 'featured' => false, 'status' => 'active', 'image' => 'https://images.unsplash.com/photo-1505693416388-ac5ce068fe85?auto=format&fit=crop&w=900&q=80', 'description' => 'Warm lighting for cozy space.'],
            ['name' => 'Power Bank', 'category' => 'Electronics', 'price' => 1399.00, 'stock' => 41, 'featured' => false, 'status' => 'active', 'image' => 'https://images.unsplash.com/photo-1583394838336-acd977736f90?auto=format&fit=crop&w=900&q=80', 'description' => 'Charge your devices on the go.'],
            ['name' => 'Tablet Sleeve', 'category' => 'Accessories', 'price' => 899.00, 'stock' => 55, 'featured' => false, 'status' => 'active', 'image' => 'https://images.unsplash.com/photo-1546868871-7041f2a55e12?auto=format&fit=crop&w=900&q=80', 'description' => 'Protective sleeve for tablets.'],
            ['name' => 'Waterproof Jacket', 'category' => 'Fashion', 'price' => 2699.00, 'stock' => 17, 'featured' => true, 'status' => 'active', 'image' => 'https://images.unsplash.com/photo-1521572267360-ee0c2909d518?auto=format&fit=crop&w=900&q=80', 'description' => 'Weatherproof daily jacket.'],
            ['name' => 'Noise Cancelling Headphones', 'category' => 'Electronics', 'price' => 4599.00, 'stock' => 15, 'featured' => true, 'status' => 'active', 'image' => 'https://images.unsplash.com/photo-1546435770-a3e426bf472b?auto=format&fit=crop&w=900&q=80', 'description' => 'Premium sound with deep focus.'],
            ['name' => 'Camera Lens', 'category' => 'Electronics', 'price' => 7599.00, 'stock' => 8, 'featured' => true, 'status' => 'active', 'image' => 'https://images.unsplash.com/photo-1516035069371-29a1b244cc32?auto=format&fit=crop&w=900&q=80', 'description' => 'High-quality optics for photography.'],
            ['name' => 'Face Serum', 'category' => 'Beauty', 'price' => 899.00, 'stock' => 45, 'featured' => false, 'status' => 'active', 'image' => 'https://images.unsplash.com/photo-1522335789203-aabd1fc54bc9?auto=format&fit=crop&w=900&q=80', 'description' => 'Skin nourishing daily serum.'],
        ];

        foreach ($products as $item) {
            $category = $categories->get($item['category']);

            Product::firstOrCreate([
                'name' => $item['name'],
                'category_id' => $category?->id,
            ], [
                'description' => $item['description'],
                'price' => $item['price'],
                'stock' => $item['stock'],
                'featured' => $item['featured'],
                'status' => $item['status'],
                'image' => $item['image'],
            ]);
        }
    }
}
