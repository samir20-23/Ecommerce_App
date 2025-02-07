<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('products')->insert([
            [
                'title' => 'Rolex Submariner',
                'content' => 'A luxury Swiss automatic watch, known for its robust design and iconic look.',
                'price' => 8500.00,
                'stock' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Apple Watch Series 8',
                'content' => 'A smart wearable with advanced health tracking features and customizable bands.',
                'price' => 399.99,
                'stock' => 30,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Casio G-Shock',
                'content' => 'A rugged, durable watch designed for extreme sports and outdoor activities.',
                'price' => 129.99,
                'stock' => 50,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Samsung Galaxy Watch 5',
                'content' => 'A smartwatch with advanced fitness tracking, heart rate monitoring, and battery-saving features.',
                'price' => 299.99,
                'stock' => 20,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Tag Heuer Monaco',
                'content' => 'A stylish luxury chronograph with a distinctive square case and premium leather straps.',
                'price' => 4500.00,
                'stock' => 8,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Fossil Hybrid HR',
                'content' => 'A hybrid smartwatch with traditional analog style and smart features like fitness tracking and notifications.',
                'price' => 179.99,
                'stock' => 25,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Seiko Presage',
                'content' => 'A traditional mechanical watch with a classic design and premium craftsmanship.',
                'price' => 450.00,
                'stock' => 15,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Garmin Fenix 7',
                'content' => 'A smartwatch designed for outdoor enthusiasts, featuring GPS tracking, heart rate monitoring, and weather alerts.',
                'price' => 799.99,
                'stock' => 10,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}



