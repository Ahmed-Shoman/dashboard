@extends('layouts.app')

@section('content')
    <div class="bg-gray-100 p-6">
        <div class="max-w-7xl mx-auto bg-white p-6 rounded-lg shadow-lg">
            <h1 class="text-2xl font-bold mb-6">Edit Category</h1>

            <!-- Edit Category Form -->
            <form action="{{ route('categories.update', $category->id) }}" method="POST" class="space-y-4">
                @csrf
                @method('PUT')

                <!-- Title Input -->
                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                    <input
                        type="text"
                        id="title"
                        name="title"
                        value="{{ old('title', $category->title) }}"
                        class="mt-1 px-4 py-2 border rounded-lg w-full focus:outline-none focus:ring-2 focus:ring-blue-500"
                        required
                    >
                </div>

                <!-- Details Input -->
                <div>
                    <label for="details" class="block text-sm font-medium text-gray-700">Details</label>
                    <textarea
                        id="details"
                        name="details"
                        class="mt-1 px-4 py-2 border rounded-lg w-full focus:outline-none focus:ring-2 focus:ring-blue-500"
                        required
                    >{{ old('details', $category->details) }}</textarea>
                </div>

                <!-- Submit Button -->
                <div class="pt-4">
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Update Category</button>
                </div>
            </form>
        </div>
    </div>
@endsection
