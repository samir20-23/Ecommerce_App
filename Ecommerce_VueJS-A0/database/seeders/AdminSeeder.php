<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Repositories\UserRepositoryInterface;

class AdminSeeder extends Seeder
{
    protected $userRepo;

    // Inject the repository into the seeder
    public function __construct(UserRepositoryInterface $userRepo)
    {
        $this->userRepo = $userRepo;
    }

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create an admin user
        $this->userRepo->create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('adminpassword'),  // Store hashed password
            'role' => 'admin',
        ]);
        $this->userRepo->create([
            'name' => 'Admin2',
            'email' => 'admin2@example.com',
            'password' => bcrypt('adminpassword2'),  // Store hashed password
            'role' => 'admin2',
        ]);
        $this->userRepo->create([
            'name' => 'user',
            'email' => 'user@example.com',
            'password' => bcrypt('user'),  // Store hashed password
            'role' => 'user',
        ]);
        $this->userRepo->create([
            'name' => 'user2',
            'email' => 'user2@example.com',
            'password' => bcrypt('user2'),  // Store hashed password
            'role' => 'user2',
        ]);
        $this->userRepo->create([
            'name' => 'user3',
            'email' => 'user3@example.com',
            'password' => bcrypt('user3'),  // Store hashed password
            'role' => 'user3',
        ]);
    }
}
