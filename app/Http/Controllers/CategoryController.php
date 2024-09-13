<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{



    // Display a listing of the categories
    public function index(Request $request)
    {

        // Get the search term if available
        $search = $request->input('search');

        // Start a query on the Category model
        $query = Category::query();

        // Filter categories by title or details if a search term is provided
        if ($search) {
            $query->where('title', 'like', "%{$search}%")
                  ->orWhere('details', 'like', "%{$search}%");
        }

        // Get the paginated list of categories (10 per page)
        $categories = $query->paginate(10);

        // Return the categories index view with the paginated categories
        return view('admin.categories.index', compact('categories'));
    }

    // Display the form for creating a new category
    public function create()
    {
        return view('admin.categories.create');
    }

    // Store a newly created category in the database
    public function store(Request $request)
    {
        // Validate the input data
        $request->validate([
            'title' => 'required|max:255',
            'details' => 'required',
        ]);

        // Create a new category instance and save it to the database
        Category::create([
            'title' => $request->input('title'),
            'details' => $request->input('details'),
        ]);

        // Redirect back with a success message
        return view('admin.categories.index');
    }

    // Show the form for editing a specific category
    public function edit($id)
    {
        // Find the category by ID or throw a 404 error if not found
        $category = Category::findOrFail($id);

        // Return the edit view with the category data
        return view('admin.categories.edit', compact('category'));
    }

    // Update the specified category in the database
    public function update(Request $request, $id)
    {
        // Find the category by ID or throw a 404 error if not found
        $category = Category::findOrFail($id);

        // Validate the input data
        $request->validate([
            'title' => 'required|max:255',
            'details' => 'required',
        ]);

        // Update the category with new data
        $category->update([
            'title' => $request->input('title'),
            'details' => $request->input('details'),
        ]);

        // Redirect back with a success message
        return redirect()->route('categories.index')->with('success', 'Category updated successfully.');
    }

    // Remove the specified category from the database
    public function destroy($id)
    {
        // Find the category by ID or throw a 404 error if not found
        $category = Category::findOrFail($id);

        // Delete the category
        $category->delete();

        // Redirect back with a success message
        return redirect()->route('categories.index')->with('success', 'Category deleted successfully.');
    }
}
