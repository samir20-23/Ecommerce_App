<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    // List all products
    public function index()
    {
        $products = Product::all();
        return view('admin.dashboard', compact('products'));
    }

    // Show form for creating a product
    public function create()
    {
        return view('admin.create');
    }

    // Store a new product
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'img_path' => 'nullable|string',
            'stock' => 'required|integer',
        ]);

        Product::create($validated);

        return redirect()->route('dashboard.index')->with('success', 'Product created successfully.');
    }

    // Show a single product
    public function show(Product $product)
    {
        return view('admin.show', compact('product'));
    }

    // Show form for editing a product
    public function edit(Product $product)
    {
        return view('admin.edit', compact('product'));
    }

    // Update a product
    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'img_path' => 'nullable|string',
            'stock' => 'required|integer',
        ]);

        $product->update($validated);

        return redirect()->route('dashboard.index')->with('success', 'Product updated successfully.');
    }

    // Delete a product
    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('dashboard.index')->with('success', 'Product deleted successfully.');
    }
}
