@extends('layouts.app')

@section('content')
    <div class="bg-gray-100 p-6">
        <div class="max-w-7xl mx-auto bg-white p-6 rounded-lg shadow-lg">
            <h1 class="text-2xl font-bold mb-6">Edit User</h1>

            <!-- Edit User Form -->
            <form action="{{ route('users.update', $user->id) }}" method="POST" class="space-y-4">
                @csrf
                @method('PUT')

                <!-- Name Input -->
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                    <input
                        type="text"
                        id="name"
                        name="name"
                        value="{{ old('name', $user->name) }}"
                        class="mt-1 px-4 py-2 border rounded-lg w-full focus:outline-none focus:ring-2 focus:ring-blue-500"
                        required
                    >
                </div>

                <!-- Email Input -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        value="{{ old('email', $user->email) }}"
                        class="mt-1 px-4 py-2 border rounded-lg w-full focus:outline-none focus:ring-2 focus:ring-blue-500"
                        required
                    >
                </div>

                <!-- Password Input (Optional) -->
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700">Password (Leave blank if not changing)</label>
                    <input
                        type="password"
                        id="password"
                        name="password"
                        class="mt-1 px-4 py-2 border rounded-lg w-full focus:outline-none focus:ring-2 focus:ring-blue-500"
                    >
                </div>

                <!-- Submit Button -->
                <div class="pt-4">
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Update User</button>
                </div>
            </form>
        </div>
    </div>
@endsection
