<?php

namespace App\Http\Controllers;

use App\Repositories\ProductRepositoryInterface;
use App\Repositories\UserRepositoryInterface;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    protected $productRepository;
    protected $userRepository;

    // Inject the repositories into the constructor
    public function __construct(ProductRepositoryInterface $productRepository, UserRepositoryInterface $userRepository)
    {
        $this->productRepository = $productRepository;
        $this->userRepository = $userRepository;
    }

    // List all products and users, and count the total products and users
    public function index()
    {
        $products = $this->productRepository->getAll();
        $users = $this->userRepository->all();
        $totalProducts = $this->productRepository->getCount();
        $totalUsers = $this->userRepository->count();

        return view('dashboard', compact('products', 'users', 'totalProducts', 'totalUsers'));
    }
}
