<?php

namespace App\Http\Controllers;
 
use App\Repositories\ProductRepositoryInterface;
use App\Repositories\UserRepositoryInterface;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    protected $productRepository;
    protected $userRepository;

    public function __construct(ProductRepositoryInterface $productRepository, UserRepositoryInterface $userRepository)
    {
        $this->productRepository = $productRepository;
        $this->userRepository = $userRepository;
    }

    // List all products
    public function index()
    {
        $products = $this->productRepository->getAll();
        $users = $this->userRepository->all();  // Corrected here
        $totalProducts = $this->productRepository->count();
        $totalUsers = $this->userRepository->count();  // Corrected here
        return view('dashboard', compact('products', 'users', 'totalProducts', 'totalUsers'));
    }
}
