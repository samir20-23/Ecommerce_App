<?php

namespace App\Http\Controllers;

use App\Repositories\ProductRepositoryInterface;
use App\Repositories\UserRepositoryInterface;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    protected $productRepository;
    protected $userRepository;  // Renamed to follow the proper convention

    public function __construct(ProductRepositoryInterface $productRepository, UserRepositoryInterface $userRepository)
    {
        $this->productRepository = $productRepository;
        $this->userRepository = $userRepository;  // Renamed to follow the proper convention
    }

    // Display a listing of the resource
    public function index()
    {
        $products = $this->productRepository->query()->paginate(9);;
        $users = $this->userRepository->All();  
        return view('product.index', compact('products', 'users'));
        
    }
    public function show($id)
    {
        $product = $this->productRepository->getById($id);

        if (!file_exists(public_path($product->img_path))) {
            $product->img_path = 'images/products/default.png';
        }

        return view('product.show', compact('product'));
    }
}
