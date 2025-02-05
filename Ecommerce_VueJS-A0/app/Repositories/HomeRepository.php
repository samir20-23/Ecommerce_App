<?php

namespace App\Repositories;

use App\Models\Product;

class HomeRepository implements HomeRepositoryInterface
{
    public function getAll()
    {
        return Product::all();
    }
    public function paginate()
    {
        return Product::paginate(6);
    }
    public function query()
    {
        return Product::query();
    }
    public function count()
    {
        return Product::count();
    }
    public function getById($id)
    {
        return Product::findOrFail($id);
    }

    // public function create(array $data)
    // {
    //     return Product::create($data);
    // }

    // public function update($id, array $data)
    // {
    //     $product = Product::findOrFail($id);
    //     $product->update($data);
    //     return $product;
    // }

    // public function delete($id)
    // {
    //     $product = Product::findOrFail($id);
    //     $product->delete();
    //     return $product;
    // }
}
