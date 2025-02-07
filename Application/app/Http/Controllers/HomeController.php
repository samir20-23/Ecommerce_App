<?php 

namespace App\Http\Controllers;

use App\Repositories\ProductRepositoryInterface;
use Illuminate\Http\Request; 

class HomeController extends Controller
{
    protected $productRepository;

    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function index()
    {
        $products =$this->productRepository->paginate();   
       return view('product.index',compact('products'));
    }
    public function show($id)
    {
        $product = $this->productRepository->getById($id);
        return view('product.show', compact('product'));
    }
   }
  