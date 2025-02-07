<?php

namespace App\Http\Controllers;

use App\Repositories\UserRepositoryInterface;
use App\Repositories\ProductRepositoryInterface;

use App\Repositories\User;

use Illuminate\Http\Request;


class DashboardController extends Controller
{

    protected $productRepository, $UserRepository;

    public function __construct(ProductRepositoryInterface $productRepository, UserRepositoryInterface  $UserRepository)
    {
        $this->productRepository = $productRepository;
        $this->UserRepository = $UserRepository;
    }
    // List all products
    public function index()
    {

        $products = $this->productRepository->getAll();
        $users = $this->UserRepository->getAll();
        $totalProducts = $this->productRepository->count();
        $totalUsers = $this->UserRepository->count();
        return view('dashboard', compact('products', 'users', 'totalProducts', 'totalUsers'));
    }
}
