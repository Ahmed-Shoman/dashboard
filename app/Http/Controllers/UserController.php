<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // Show the list of users.
    public function index(Request $request)
    {
        $search = $request->input('search');

        $query = User::query();

        if ($search) {
            $query->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
        }

        $users = $query->paginate(10);

        return view('admin.users.index', compact('users'));
    }

    // Show the form for creating a new user.
    public function create()
    {
       return view('admin.users.create');
    }

    // Store a newly created user in the database.
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        return redirect()->route('users.index')->with('success', 'User created successfully.');
    }

    // Show the form for editing a user.
    public function edit($id)
    {
        // Find the user by ID or throw a 404 error if not found
        $user = User::findOrFail($id);

        // Pass the user data to the 'edit' view
        return view('admin.users.edit', compact('user'));
    }

    // Update the user in the database.
    public function update(Request $request, $id)
    {
        // Find the user by id
        $user = User::findOrFail($id);

        // Validate the request
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id, // Ignore the current user's email
            'password' => 'nullable|string|min:8|confirmed', // Password is optional
        ]);

        // Update the user's name and email
        $user->name = $request->name;
        $user->email = $request->email;

        // Only update the password if a new one was provided
        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
        }

        // Save the updated user
        $user->save();

        // Redirect back with a success message
        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }

    // Delete the user.
    public function destroy($id)
    {
        // Find the user by id
        $user = User::findOrFail($id);

        // Delete the user
        $user->delete();

        // Redirect back to the users list with a success message
        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }
}
