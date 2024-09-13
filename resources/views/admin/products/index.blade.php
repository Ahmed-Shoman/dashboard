@extends('layouts.app')

@section('content')
    <div class="bg-gray-100 p-6">
        <div class="max-w-7xl mx-auto bg-white p-6 rounded-lg shadow-lg">
            <h1 class="text-2xl font-bold mb-6">Product Management</h1>

            <!-- Search and Filter -->
            <div class="mb-4 flex justify-between">
                <form action="{{ route('products.index') }}" method="GET" class="flex space-x-2">
                    <!-- Search box -->
                    <input
                        type="text"
                        name="search"
                        placeholder="Search by product name..."
                        value="{{ request('search') }}"
                        class="px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                    >
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Search</button>
                </form>
            </div>

            <!-- Products Table -->
            <table class="min-w-full bg-white border border-gray-200 rounded-lg">
                <thead>
                    <tr class="bg-gray-100 text-gray-600">
                        <th class="py-3 px-6 text-left">ID</th>
                        <th class="py-3 px-6 text-left">Title</th>
                        <th class="py-3 px-6 text-left">Brand</th>
                        <th class="py-3 px-6 text-left">Image</th>
                        <th class="py-3 px-6 text-left">Price</th>
                        <th class="py-3 px-6 text-left">Category</th>
                        <th class="py-3 px-6 text-left">Details</th>
                        <th class="py-3 px-6 text-left">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $product)
                    <tr class="border-b border-gray-200">
                        <td class="py-3 px-6">{{ $product->id }}</td>
                        <td class="py-3 px-6">{{ $product->title }}</td>
                        <td class="py-3 px-6">{{ $product->brand }}</td>
                        <td class="py-3 px-6">
                            @if($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->title }}" class="w-20 h-20 object-cover">
                            @else
                                No Image
                            @endif
                        </td>
                        <td class="py-3 px-6">${{ number_format($product->price, 2) }}</td>
                        <td class="py-3 px-6">{{ $product->category_id }}</td>
                        <td class="py-3 px-6 truncate" style="max-width: 150px;">{{ $product->details }}</td>
                        <td class="py-3 px-6 flex space-x-2">
                            <a href="{{ route('products.edit', $product->id) }}" class="bg-green-600 text-white px-3 py-1 rounded hover:bg-green-700">Edit</a>
                            <form action="{{ route('products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this product?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <a href="{{ route('products.create') }}" class="mt-6 inline-block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Create New Product</a>
        </div>
    </div>
@endsection
