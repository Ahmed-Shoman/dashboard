@extends('layouts.app')

@section('content')
    <div class="bg-gray-100 p-6">
        <div class="max-w-7xl mx-auto bg-white p-6 rounded-lg shadow-lg">
            <h1 class="text-2xl font-bold mb-6">Edit Product</h1>

            <!-- Edit Product Form -->
            <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf
                @method('PUT')

                <!-- Title Input -->
                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                    <input
                        type="text"
                        id="title"
                        name="title"
                        value="{{ old('title', $product->title) }}"
                        class="mt-1 px-4 py-2 border rounded-lg w-full focus:outline-none focus:ring-2 focus:ring-blue-500"
                        required
                    >
                </div>

                <!-- Brand Input -->
                <div>
                    <label for="brand" class="block text-sm font-medium text-gray-700">Brand</label>
                    <input
                        type="text"
                        id="brand"
                        name="brand"
                        value="{{ old('brand', $product->brand) }}"
                        class="mt-1 px-4 py-2 border rounded-lg w-full focus:outline-none focus:ring-2 focus:ring-blue-500"
                        required
                    >
                </div>

                <!-- Image Input -->
                <div>
                    <label for="image" class="block text-sm font-medium text-gray-700">Product Image</label>
                    <input
                        type="file"
                        id="image"
                        name="image"
                        class="mt-1 px-4 py-2 border rounded-lg w-full focus:outline-none focus:ring-2 focus:ring-blue-500"
                    >
                    @if ($product->image)
                        <p class="mt-2 text-sm text-gray-500">Current Image: <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->title }}" class="h-20"></p>
                    @endif
                </div>

                <!-- Price Input -->
                <div>
                    <label for="price" class="block text-sm font-medium text-gray-700">Price</label>
                    <input
                        type="number"
                        id="price"
                        name="price"
                        value="{{ old('price', $product->price) }}"
                        step="0.01"
                        class="mt-1 px-4 py-2 border rounded-lg w-full focus:outline-none focus:ring-2 focus:ring-blue-500"
                        required
                    >
                </div>

                <!-- Category Dropdown -->
                <div>
                    <label for="category_id" class="block text-sm font-medium text-gray-700">Category</label>
                    <select
                        id="category_id"
                        name="category_id"
                        class="mt-1 px-4 py-2 border rounded-lg w-full focus:outline-none focus:ring-2 focus:ring-blue-500"
                        required
                    >
                        <option value="">Select a Category</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                                {{ $category->title }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Details Input -->
                <div>
                    <label for="details" class="block text-sm font-medium text-gray-700">Details</label>
                    <textarea
                        id="details"
                        name="details"
                        class="mt-1 px-4 py-2 border rounded-lg w-full focus:outline-none focus:ring-2 focus:ring-blue-500"
                        required
                    >{{ old('details', $product->details) }}</textarea>
                </div>

                <!-- Submit Button -->
                <div class="pt-4">
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Update Product</button>
                </div>
            </form>
        </div>
    </div>
@endsection
