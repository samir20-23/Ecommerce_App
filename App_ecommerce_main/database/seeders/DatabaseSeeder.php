<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            ProductSeeder::class,
            AdminSeeder::class,
            RoleSeeder::class,
        ]);
    }
}
