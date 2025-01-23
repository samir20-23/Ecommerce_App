<?php

namespace App\Http\Controllers;

use App\Repositories\ProductRepository;

class ProductController extends Controller
{
    protected $productRepo;

    public function __construct(ProductRepository $productRepo)
    {
        $this->productRepo = $productRepo;
    }

    public function index()
    {
        $products = $this->productRepo->all();
        return view('products.index', compact('products')); 
    }
}
