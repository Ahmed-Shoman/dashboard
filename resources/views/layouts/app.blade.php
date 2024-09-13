<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Default Title')</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 flex">
    <!-- Sidebar -->
    <aside class="w-64 bg-gray-900 text-white min-h-screen">
        <div class="p-6">
            <h1 class="text-3xl font-bold mb-8">Dashboard</h1>
            <nav>
                <ul class="space-y-2">
                    <li>
                        <a href="{{ route('products.index') }}" class="block py-3 px-4 rounded-lg hover:bg-gray-700 transition duration-300">
                            <i class="fas fa-box mr-2"></i> Products
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('categories.index') }}" class="block py-3 px-4 rounded-lg hover:bg-gray-700 transition duration-300">
                            <i class="fas fa-tags mr-2"></i> Categories
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('users.index') }}" class="block py-3 px-4 rounded-lg hover:bg-gray-700 transition duration-300">
                            <i class="fas fa-users mr-2"></i> Users
                        </a>
                    </li>
                    <!-- Add more links as needed -->
                </ul>
            </nav>
        </div>
    </aside>

    <!-- Main Content -->
    <div class="flex-1">
        <header class="bg-blue-600 text-white p-4">
            <nav class="max-w-7xl mx-auto">
                <a href="{{ url('/') }}" class="text-lg font-bold">Home</a>
                <!-- Add other navigation items if needed -->
            </nav>
        </header>
        <main class="py-6 px-8">
            @yield('content')
        </main>
    </div>

    <!-- Include FontAwesome for icons -->
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</body>
</html>
