<?php

namespace App\Repositories;

interface ProductRepositoryInterface
{
    public function getAll();          // Fetch all products
    public function getCount();        // Get total count of products
    public function getById($id);      // Fetch product by ID
    public function create(array $data); // Create a new product
    public function update($id, array $data); // Update a product
    public function delete($id);      // Delete a product
}
