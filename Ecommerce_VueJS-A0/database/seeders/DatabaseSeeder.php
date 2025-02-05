<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    public function run()
    { 
            // Call the ProductSeeder 
            $this->call(AdminSeeder::class);
            $this->call(ProductSeeder::class);
    
        
    }
}
