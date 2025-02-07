<?php 

namespace App\Http\Controllers;

use App\Repositories\ProductRepositoryInterface;
use Illuminate\Http\Request; 

class ManageProducts extends Controller
{
    protected $productRepository;

    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function index(Request $request)
    {
        $query = $this->productRepository->query();

        if ($request->has('min_price') && $request->has('max_price')) {
            $query->whereBetween('price', [$request->min_price, $request->max_price]);
        }

        if ($request->has('in_stock')) {
            $query->where('stock', '>', 0);
        }

        if ($request->has('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        $products = $query->paginate(10);  

        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        return view('admin.products.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:500',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'img_path' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        $imgPath = null;

        if ($request->hasFile('img_path')) {
            $imageName = time() . '_' . $request->file('img_path')->getClientOriginalName();
            $request->file('img_path')->move(public_path('images/products'), $imageName);
            $imgPath = 'images/products/' . $imageName;
        }

        $product = $this->productRepository->create([
            'title' => $request->title,
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock,
            'img_path' => $imgPath,
        ]);

        return response()->json(['message' => 'Product added successfully!', 'product' => $product]);
    }

    public function show($id)
    {
        $product = $this->productRepository->getById($id);

        if (!file_exists(public_path($product->img_path))) {
            $product->img_path = 'images/products/default.png';
        }

        return view('admin.products.show', compact('product'));
    }

    public function edit($id)
    {
        $product = $this->productRepository->getById($id);
        return view('admin.products.edit', compact('product'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:500',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'img_path' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        $product = $this->productRepository->getById($id);
        $imgPath = $product->img_path;

        if ($request->hasFile('img_path')) {
            if ($imgPath && file_exists(public_path($imgPath))) {
                unlink(public_path($imgPath));
            }
            $imageName = time() . '_' . $request->file('img_path')->getClientOriginalName();
            $request->file('img_path')->move(public_path('images/products'), $imageName);
            $imgPath = 'images/products/' . $imageName;
        }

        $product->update([
            'title' => $request->title,
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock,
            'img_path' => $imgPath,
        ]);

        return response()->json(['message' => 'Product updated successfully!', 'product' => $product]);
    }

    public function destroy($id)
    {
        $product = $this->productRepository->getById($id);
        if ($product->img_path && file_exists(public_path($product->img_path))) {
            unlink(public_path($product->img_path));
        }
        $product->delete();

        return response()->json(['message' => 'Product deleted successfully!']);
    }
}
