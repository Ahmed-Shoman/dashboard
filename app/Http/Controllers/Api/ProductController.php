<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    // Get a list of all products
    public function index()
    {
        return response()->json(Product::all());
    }

    // Store a new product
   public function store(Request $request)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'brand' => 'required|string|max:255',
        'price' => 'required|numeric',
        'details' => 'nullable|string',
        'category_id' => 'required|exists:categories,id',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $product = new Product();
    $product->title = $request->input('title');
    $product->brand = $request->input('brand');
    $product->price = $request->input('price');
    $product->details = $request->input('details');
    $product->category_id = $request->input('category_id');

    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('public/images');
        $product->image = $imagePath;
    }

    $product->save();

    return response()->json($product, 201);
}

    // Get a single product by ID
    public function show($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        return response()->json($product);
    }

    // Update an existing product
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'brand' => 'required|string|max:255',
            'price' => 'required|numeric',
            'details' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $product = Product::find($id);

        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        $data = $request->all();

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete the old image if it exists
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }

            $data['image'] = $request->file('image')->store('product_images', 'public');
        }

        $product->update($data);

        return response()->json($product);
    }

    // Delete a product
    public function destroy($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        // Delete the product image if it exists
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();

        return response()->json(null, 204);
    }
}
