@extends('layouts.app')

@section('content')
    <div class="bg-gray-100 p-6">
        <div class="max-w-7xl mx-auto bg-white p-6 rounded-lg shadow-lg">
            <h1 class="text-2xl font-bold mb-6">Create New Product</h1>

            <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- Title Input -->
                <div class="mb-4">
                    <label for="title" class="block text-gray-700 font-semibold mb-2">Title</label>
                    <input
                        type="text"
                        name="title"
                        id="title"
                        value="{{ old('title') }}"
                        class="px-4 py-2 border rounded-lg w-full focus:outline-none focus:ring-2 focus:ring-blue-500"
                    >
                    @error('title')
                        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Brand Input -->
                <div class="mb-4">
                    <label for="brand" class="block text-gray-700 font-semibold mb-2">Brand</label>
                    <input
                        type="text"
                        name="brand"
                        id="brand"
                        value="{{ old('brand') }}"
                        class="px-4 py-2 border rounded-lg w-full focus:outline-none focus:ring-2 focus:ring-blue-500"
                    >
                    @error('brand')
                        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Image Input -->
                <div class="mb-4">
                    <label for="image" class="block text-gray-700 font-semibold mb-2">Product Image</label>
                    <input
                        type="file"
                        name="image"
                        id="image"
                        class="px-4 py-2 border rounded-lg w-full focus:outline-none focus:ring-2 focus:ring-blue-500"
                    >
                    @error('image')
                        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Price Input -->
                <div class="mb-4">
                    <label for="price" class="block text-gray-700 font-semibold mb-2">Price</label>
                    <input
                        type="number"
                        name="price"
                        id="price"
                        value="{{ old('price') }}"
                        step="0.01"
                        class="px-4 py-2 border rounded-lg w-full focus:outline-none focus:ring-2 focus:ring-blue-500"
                    >
                    @error('price')
                        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Category Dropdown -->
                <div class="mb-4">
                    <label for="category_id" class="block text-gray-700 font-semibold mb-2">Category</label>
                    <select
                        name="category_id"
                        id="category_id"
                        class="px-4 py-2 border rounded-lg w-full focus:outline-none focus:ring-2 focus:ring-blue-500"
                    >
                        <option value="">Select a Category</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->title }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Details Input -->
                <div class="mb-4">
                    <label for="details" class="block text-gray-700 font-semibold mb-2">Details</label>
                    <textarea
                        name="details"
                        id="details"
                        rows="4"
                        class="px-4 py-2 border rounded-lg w-full focus:outline-none focus:ring-2 focus:ring-blue-500"
                    >{{ old('details') }}</textarea>
                    @error('details')
                        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Submit Button -->
                <div class="flex justify-end">
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Create Product</button>
                </div>
            </form>
        </div>
    </div>
@endsection
