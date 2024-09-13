<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return response()->json($categories);
    }

    public function show($id)
    {
        $category = Category::find($id);
        if ($category) {
            return response()->json($category);
        } else {
            return response()->json(['message' => 'Category not found'], 404);
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'details' => 'required',
        ]);

        $category = Category::create([
            'title' => $request->input('title'),
            'details' => $request->input('details'),
        ]);

        return response()->json($category, 201);
    }

    public function update(Request $request, $id)
    {
        $category = Category::find($id);
        if ($category) {
            $request->validate([
                'title' => 'required|max:255',
                'details' => 'required',
            ]);

            $category->update([
                'title' => $request->input('title'),
                'details' => $request->input('details'),
            ]);

            return response()->json($category);
        } else {
            return response()->json(['message' => 'Category not found'], 404);
        }
    }

  
    public function destroy($id)
    {
        $category = Category::find($id);
        if ($category) {
            $category->delete();
            return response()->json(['message' => 'Category deleted successfully']);
        } else {
            return response()->json(['message' => 'Category not found'], 404);
        }
    }
}
