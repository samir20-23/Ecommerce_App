<?php

namespace App\Http\Controllers;
<<<<<<< HEAD:versions_App/liveCoding_BLADE/app/Http/Controllers/HomeController.php

=======
use App\Repositories\HomeRepositoryInterface;
>>>>>>> 97e8fbea69493b6d297afbe684e4fc5912ff81df:App_ecommerce_main/app/Http/Controllers/HomeController.php
use Illuminate\Http\Request;

class HomeController extends Controller
{
<<<<<<< HEAD:versions_App/liveCoding_BLADE/app/Http/Controllers/HomeController.php
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
=======
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
>>>>>>> 97e8fbea69493b6d297afbe684e4fc5912ff81df:App_ecommerce_main/app/Http/Controllers/HomeController.php
    }
}
