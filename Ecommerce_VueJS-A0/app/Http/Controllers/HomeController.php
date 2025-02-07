<?php

namespace App\Http\Controllers;
use App\Repositories\HomeRepositoryInterface;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    protected $HomeRepository;
    public function __construct(HomeRepositoryInterface $HomeRepository)
    {
        $this->HomeRepository = $HomeRepository;
    }

    public function index()
    {
        $products = $this->HomeRepository->paginate();
        return view('product.index', compact('products'));
    }
    public function show($id)
    {
        $product = $this->HomeRepository->getById($id);
        return view('product.show', compact('product'));
    }
}
