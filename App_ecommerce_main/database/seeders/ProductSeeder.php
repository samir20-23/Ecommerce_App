<?php

namespace Database\Seeders;

use App\Repositories\ProductRepositoryInterface;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    protected $productRepo;

    // Inject ProductRepositoryInterface
    public function __construct(ProductRepositoryInterface $productRepo)
    {
        $this->productRepo = $productRepo;
    }

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // An array of products to insert
        $products = [
            [
                'title' => 'Luxury Watch',
                'description' => 'A luxury watch for special occasions.',
                'price' => 999.99,
                'stock' => 10,
                'img_path' => 'images/products/watch_6.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Luxury Watch',
                'description' => 'A luxury watch for special occasions.',
                'price' => 999.99,
                'stock' => 10,
                'img_path' => 'images/products/watch_7.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Luxury Watch',
                'description' => 'A luxury watch for special occasions.',
                'price' => 999.99,
                'stock' => 10,
                'img_path' => 'images/products/watch_8.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Luxury Watch',
                'description' => 'A luxury watch for special occasions.',
                'price' => 999.99,
                'stock' => 10,
                'img_path' => 'images/products/watch_9.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Luxury Watch',
                'description' => 'A luxury watch for special occasions.',
                'price' => 999.99,
                'stock' => 10,
                'img_path' => 'images/products/watch_10.png',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ];

        // Iterate over the products and insert them using the repository
        foreach ($products as $productData) {
            $this->productRepo->create($productData); // Adjust method name if necessary
        }
    }
}
