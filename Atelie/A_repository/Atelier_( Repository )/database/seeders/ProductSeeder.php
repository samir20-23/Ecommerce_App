<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run()
    {
        // Add some sample products
        Product::create([
            'name' => 'Watch 1',
            'description' => 'A stylish watch for everyday use.',
            'price' => 150.00,
            'stock' => 30
        ]);

        Product::create([
            'name' => 'Watch 2',
            'description' => 'A luxury watch for special occasions.',
            'price' => 350.00,
            'stock' => 10
        ]);

        Product::create([
            'name' => 'Watch 3',
            'description' => 'A sporty watch for active people.',
            'price' => 120.00,
            'stock' => 50
        ]);
    }
}
