@extends('layouts.app')

@section('content')
    <div class="bg-gray-100 p-6">
        <div class="max-w-7xl mx-auto bg-white p-6 rounded-lg shadow-lg">
            <h1 class="text-2xl font-bold mb-6">Category Management</h1>

            <!-- Search and Filter -->
            <div class="mb-4 flex justify-between">
                <form action="{{ route('categories.index') }}" method="GET" class="flex space-x-2">
                    <!-- Search box -->
                    <input
                        type="text"
                        name="search"
                        placeholder="Search by title or details..."
                        value="{{ request('search') }}"
                        class="px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                    >

                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Search</button>
                </form>
            </div>

            <!-- Categories Table -->
            <table class="min-w-full bg-white border border-gray-200 rounded-lg">
                <thead>
                    <tr class="bg-gray-100 text-gray-600">
                        <th class="py-3 px-6 text-left">ID</th>
                        <th class="py-3 px-6 text-left">Title</th>
                        <th class="py-3 px-6 text-left">Details</th>
                        <th class="py-3 px-6 text-left">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($categories as $category)
                    <tr class="border-b border-gray-200">
                        <td class="py-3 px-6">{{ $category->id }}</td>
                        <td class="py-3 px-6">{{ $category->title }}</td>
                        <td class="py-3 px-6">{{ $category->details }}</td>
                        <td class="py-3 px-6 flex space-x-2">
                            <a href="{{ route('categories.edit', $category->id) }}
" class="bg-green-600 text-white px-3 py-1 rounded hover:bg-green-700">Edit</a>
                            <form action="{{ route('categories.destroy', $category->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this category?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <a href="{{ route('categories.create') }}" class="mt-6 inline-block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Create New Category</a>
        </div>
    </div>
@endsection
