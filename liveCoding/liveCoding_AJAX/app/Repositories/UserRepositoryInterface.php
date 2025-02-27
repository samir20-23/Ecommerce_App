<?php

namespace App\Repositories;

interface UserRepositoryInterface
{
    public function all();

    public function create(array $data);
    
    public function count();

    public function paginate();

    public function update(array $data, $id);

    public function delete($id);

    public function find($id);
}
