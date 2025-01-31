<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::create([
            'title' => 'Classic Watch',
            'description' => 'A timeless classic wristwatch for every occasion.',
            'price' => 199.99,
            'stock' => 50,
            'img_path' => 'images/products/watch_1.png', // Use forward slashes
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Product::create([
            'title' => 'Digital Watch',
            'description' => 'Modern digital watch with various features.',
            'price' => 99.99,
            'stock' => 100,
            'img_path' => 'images/products/watch_2.png', // Use forward slashes
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Product::create([
            'title' => 'Luxury Watch 1',
            'description' => 'A luxury watch for special occasions.',
            'price' => 999.99,
            'stock' => 10,
            'img_path' => 'images/products/watch_3.png', // Use forward slashes
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Product::create([
            'title' => 'Luxury Watch 2',
            'description' => 'A luxury watch for special occasions.',
            'price' => 999.99,
            'stock' => 10,
            'img_path' => 'images/products/watch_4.png', // Use forward slashes
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Product::create([
            'title' => 'Luxury Watch 3',
            'description' => 'A luxury watch for special occasions.',
            'price' => 999.99,
            'stock' => 10,
            'img_path' => 'images/products/watch_5.png', // Use forward slashes
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Product::create([
            'title' => 'Luxury Watch 4',
            'description' => 'A luxury watch for special occasions.',
            'price' => 999.99,
            'stock' => 10,
            'img_path' => 'images/products/watch_6.png', // Use forward slashes
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Product::create([
            'title' => 'Luxury Watch 5',
            'description' => 'A luxury watch for special occasions.',
            'price' => 999.99,
            'stock' => 10,
            'img_path' => 'images/products/watch_7.png', // Use forward slashes
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Product::create([
            'title' => 'Luxury Watch 6',
            'description' => 'A luxury watch for special occasions.',
            'price' => 999.99,
            'stock' => 10,
            'img_path' => 'images/products/watch_8.png', // Use forward slashes
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Product::create([
            'title' => 'Luxury Watch 7',
            'description' => 'A luxury watch for special occasions.',
            'price' => 999.99,
            'stock' => 10,
            'img_path' => 'images/products/watch_9.png', // Use forward slashes
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Product::create([
            'title' => 'Luxury Watch 8',
            'description' => 'A luxury watch for special occasions.',
            'price' => 999.99,
            'stock' => 10,
            'img_path' => 'images/products/watch_10.png', // Use forward slashes
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
