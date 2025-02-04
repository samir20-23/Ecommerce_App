<?php

namespace App\Repositories;

use PhpParser\Builder\Function_;

interface HomeRepositoryInterface
{
    public function getAll();
    public function paginate();
    public function query();
    public function count();
    public function getById($id);
    // public function create(array $data);
    // public function update($id, array $data);
    // public function delete($id);
}
