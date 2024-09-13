<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    // Display a listing of the products
    public function index(Request $request)
    {
        $search = $request->input('search');
        $products = Product::when($search, function ($query, $search) {
            return $query->where('title', 'like', "%{$search}%");
        })->paginate(10);

        return view('admin.products.index', compact('products'));
    }

    // Show the form for creating a new product
    public function create()
    {
        $categories = Category::all(); // Fetch all categories for the dropdown
        return view('admin.products.create', compact('categories'));
    }

    // Store a newly created product in storage
    public function store(Request $request)
    {
        // Validate the request data
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'brand' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id', // Ensure category_id is valid
            'details' => 'nullable|string',
        ]);

        // Handle the image upload
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('product_images', 'public');
            $validated['image'] = $imagePath;
        }

        // Create a new product with the validated data
        Product::create($validated);

        // Redirect to the product index page with a success message
        return redirect()->route('products.index')
                         ->with('success', 'Product created successfully.');
    }

    // Display the specified product (optional)
    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    // Show the form for editing the specified product
    public function edit(Product $product)
    {
        $categories = Category::all(); // Fetch all categories for the dropdown
        return view('admin.products.edit', compact('product', 'categories'));
    }

    // Update the specified product in storage
    public function update(Request $request, Product $product)
    {
        // Validate the request data
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'brand' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id', // Ensure category_id is valid
            'details' => 'nullable|string',
        ]);

        // Handle the image upload
        if ($request->hasFile('image')) {
            // Delete the old image if it exists
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            $imagePath = $request->file('image')->store('product_images', 'public');
            $validated['image'] = $imagePath;
        }

        // Update the product with the validated data
        $product->update($validated);

        // Redirect to the product index page with a success message
        return redirect()->route('products.index')
                         ->with('success', 'Product updated successfully.');
    }

    // Remove the specified product from storage
    public function destroy(Product $product)
    {
        // Delete the image if it exists
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }

        // Delete the product
        $product->delete();

        // Redirect to the product index page with a success message
        return redirect()->route('products.index')
                         ->with('success', 'Product deleted successfully.');
    }
}
