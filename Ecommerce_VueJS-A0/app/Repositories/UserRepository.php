<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository implements UserRepositoryInterface {

    public function getAll()
    {
        return User::all();
    }
    public function paginate()
    {
        return User::paginate(6);
    }
    public function query()
    {
        return User::query();
    }
    public function count()
    {
        return User::count();
    }
    public function getById($id)
    {
        return User::findOrFail($id);
    }

    public function create(array $data)
    {
        return User::create($data);
    }

    public function update(array $data, $id)
    {
        $product = User::findOrFail($id);
        $product->update($data);
        return $product;
    }

    public function delete($id)
    {
        $product = User::findOrFail($id);
        $product->delete();
        return $product;
    }
}
