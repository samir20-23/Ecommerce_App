<?php

namespace App\Repositories;

interface ProductRepositoryInterface
{
    public function getAll();
    public function query();
    public function count();
    public function paginate();
    public function getById($id);
    public function create(array $data);
    public function update($id, array $data);
    public function delete($id);
    
}
