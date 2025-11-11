<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'HelpDeskly') - The Modern Support Ticket Platform</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    
    <!-- Tailwind CSS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    @stack('styles')
</head>
<body class="bg-linear-to-br from-blue-50 to-indigo-100 min-h-screen font-sans antialiased">
    <div class="flex flex-col sm:justify-center items-center min-h-screen p-4">
        <!-- Logo/Header -->
        <div class="w-full max-w-md text-center mb-8">
            <a href="{{ route('home') }}" class="inline-flex items-center justify-center space-x-3">
                <div class="bg-blue-600 p-3 rounded-xl shadow-lg">
                    <i class="fas fa-comments text-white text-2xl"></i>
                </div>
                <span class="text-2xl font-bold text-gray-800">HelpDeskly</span>
            </a>
            <p class="text-gray-600 mt-2 text-sm">The Modern Support Ticket Platform</p>
        </div>

        <!-- Page Content -->
        <div class="w-full max-w-md bg-white rounded-2xl shadow-xl overflow-hidden">
            @yield('content')
        </div>

        <!-- Footer Links -->
        <div class="w-full max-w-md mt-6 text-center text-sm text-gray-600">
            @yield('auth-links')
        </div>
    </div>

    @stack('scripts')
</body>
</html>