<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class VisitorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Insert multiple sample data
        DB::table('visitors')->insert([
            [
                'active' => 1,
                'age' => 16,
                'name' => 'John Doe',
                'email' => 'johndoe@example.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password123'),
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'active' => 0,
                'age' => 10,
                'name' => 'Jane Smith',
                'email' => 'janesmith@example.com',
                'email_verified_at' => null,
                'password' => Hash::make('securepass'),
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'active' => 1,
                'age' => 20,
                'name' => 'Alice Brown',
                'email' => 'alicebrown@example.com',
                'email_verified_at' => now(),
                'password' => Hash::make('mypassword'),
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}