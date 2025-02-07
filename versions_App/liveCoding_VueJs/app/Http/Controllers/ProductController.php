<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // Display a listing of products
    public function index()
    {
        $products = Product::all();
        return response()->json($products);
    }

    // Show a single product by its ID
    public function show(Product $product)
    {
        return response()->json($product);
    }

    // Store a newly created product
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'   => 'required|string|max:255',
            'content' => 'required|string',
            'price'   => 'required|numeric',
            'stock'   => 'required|integer',
        ]);

        $product = Product::create($validated);

        return response()->json($product, 201);
    }

    // Update the specified product
    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'title'   => 'required|string|max:255',
            'content' => 'required|string',
            'price'   => 'required|numeric',
            'stock'   => 'required|integer',
        ]);

        $product->update($validated);

        return response()->json($product);
    }

    // Remove the specified product
    public function destroy(Product $product)
    {
        $product->delete();

        return response()->json(['message' => 'Product deleted successfully.']);
    }
}
