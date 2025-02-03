<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ManageProducts extends Controller
{
    /**
     * Display a listing of the resource with optional filters.
     */
    public function index(Request $request)
    {
        $query = Product::query();

        // Filter by price range if both min_price and max_price are provided
        if ($request->filled('min_price') && $request->filled('max_price')) {
            $query->whereBetween('price', [$request->min_price, $request->max_price]);
        }

        // Filter by stock if requested
        if ($request->filled('in_stock') && $request->in_stock == 1) {
            $query->where('stock', '>', 0);
        }

        // Filter by title search if provided
        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        // Paginate the result (10 per page)
        $products = $query->paginate(10);

        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new product.
     */
    public function create()
    {
        return view('admin.products.create');
    }

    /**
     * Store a newly created product in storage.
     */
    public function store(Request $request)
    {
        // Validate the incoming request.
        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string|max:500',
            'price'       => 'required|numeric|min:0',
            'stock'       => 'required|integer|min:0',
            'img_path'    => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        // Process image upload, if provided.
        if ($request->hasFile('img_path')) {
            $imageName = time() . '_' . $request->file('img_path')->getClientOriginalName();
            $request->file('img_path')->move(public_path('images/products'), $imageName);
            $validated['img_path'] = 'images/products/' . $imageName;
        }

        // Create the product.
        $product = Product::create($validated);

        return response()->json([
            'message' => 'Product added successfully!',
            'product' => $product
        ]);
    }

    /**
     * Display the specified product.
     */
    public function show($id)
    {
        $product = Product::findOrFail($id);

        // If image is missing, set a default image.
        if (!$product->img_path || !file_exists(public_path($product->img_path))) {
            $product->img_path = 'images/products/default.png';
        }

        return view('admin.products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified product.
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('admin.products.edit', compact('product'));
    }

    /**
     * Update the specified product in storage.
     */
    public function update(Request $request, $id)
    {
        // Validate request.
        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string|max:500',
            'price'       => 'required|numeric|min:0',
            'stock'       => 'required|integer|min:0',
            'img_path'    => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        $product = Product::findOrFail($id);

        // Check if an image file is provided.
        if ($request->hasFile('img_path')) {
            // Delete the old image if it exists.
            if ($product->img_path && file_exists(public_path($product->img_path))) {
                @unlink(public_path($product->img_path));
            }
            $imageName = time() . '_' . $request->file('img_path')->getClientOriginalName();
            $request->file('img_path')->move(public_path('images/products'), $imageName);
            $validated['img_path'] = 'images/products/' . $imageName;
        } else {
            // Keep the current image if no new image was uploaded.
            $validated['img_path'] = $product->img_path;
        }

        // Update the product.
        $product->update($validated);

        return response()->json([
            'message' => 'Product updated successfully!',
            'product' => $product
        ]);
    }

    /**
     * Remove the specified product from storage.
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        if ($product->img_path && file_exists(public_path($product->img_path))) {
            @unlink(public_path($product->img_path));
        }
        $product->delete();

        return response()->json([
            'message' => 'Product deleted successfully!'
        ]);
    }
}
