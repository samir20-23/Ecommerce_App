<?php

namespace App\Repositories;

interface UserRepositoryInterface
{
    public function getAll();
    public function paginate();
    public function query();
    public function count();
    public function getById($id);
    public function create(array $data); 
    public function update(array $data, $id);
    public function delete($id);
}
