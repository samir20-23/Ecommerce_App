<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
  user::create([
    'name'=>'admin',
    'email'=>'admin@gmail.com',
    'password'=>bcrypt('samir123'),
    'role'=>'admin',
  ]);
    }
}

// 
