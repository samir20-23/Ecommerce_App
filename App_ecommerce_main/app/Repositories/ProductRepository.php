<?php

namespace App\Repositories;

use App\Models\Product;

class ProductRepository implements ProductRepositoryInterface
{
    public $pagination = 4;
    // Default pagination value

    public function pagination($pagination = null)
    {
        return Product::paginate($pagination ?? $this->pagination);
    }

    public function getAll()
    {
        return Product::all();
    }
    public function query()
    {
        return Product::query();
    }

    public function getCount()
    {
        return Product::count();
    }

    public function getById($id)
    {
        return Product::find($id);
    }

    public function create(array $data)
    {
        return Product::create($data);
    }

    public function update($id, array $data)
    {
        $product = Product::find($id);
        $product->update($data);
        return $product;
    }

    public function delete($id)
    {
        $product = Product::find($id);
        $product->delete();
    }
}
