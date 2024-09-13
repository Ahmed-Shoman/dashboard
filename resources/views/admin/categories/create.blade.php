@extends('layouts.app')

@section('content')
    <div class="bg-gray-100 p-6">
        <div class="max-w-7xl mx-auto bg-white p-6 rounded-lg shadow-lg">
            <h1 class="text-2xl font-bold mb-6">Create New Category</h1>

            <!-- Create Category Form -->
            <form action="{{route('categories.store') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="title" class="block text-gray-700 font-semibold mb-2">Category Title</label>
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

                <div class="mb-4">
                    <label for="details" class="block text-gray-700 font-semibold mb-2">Category Details</label>
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

                <div class="flex justify-end">
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Create Category</button>
                </div>
            </form>
        </div>
    </div>
@endsection
