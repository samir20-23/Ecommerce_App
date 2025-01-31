<?php

namespace App\Repositories;

interface UserRepositoryInterface
{
    public function all();             // Fetch all users
    public function count();           // Get total count of users
    public function create(array $data);  // Create a new user
    public function update(array $data, $id); // Update user data
    public function delete($id);       // Delete a user
    public function find($id);         // Find a user by ID
}
