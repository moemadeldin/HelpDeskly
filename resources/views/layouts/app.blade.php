<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'HelpDeskly')</title>
    <!-- Include TailwindCSS or your preferred CSS framework -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a076d05399.js"></script> <!-- For icons -->
</head>

<body class="bg-gray-100">

    <!-- Navigation (Optional) -->
    <nav class="bg-blue-600 text-white py-4">
        <div class="max-w-7xl mx-auto px-6">
            <div class="flex justify-between items-center">
                <div class="flex items-center">
                    <a href={{ route('home') }} class="text-xl font-bold">HelpDeskly</a>
                </div>
                @if(Auth::check())
                    <div class="space-x-4">
                        <a href="{{ route('profile.index') }}"
                            class="hover:text-blue-200">{{ Auth::user()->first_name ?? 'Guest'}}</a>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button class="hover:text-blue-200 #112cursor-pointer">Logout</button>
                        </form>
                    </div>
                @else
                    <div class="space-x-4">
                        <a href="{{ route('login.get') }}" class="hover:text-blue-200">Login</a>
                        <a href="{{ route('register') }}" class="hover:text-blue-200">Register</a>
                    </div>
                @endif
            </div>
        </div>
    </nav>

    <!-- Page Content -->
    <div class="min-h-screen">
        @yield('content') <!-- This is where page-specific content will go -->
    </div>

    <!-- Footer (Optional) -->
    <footer class="bg-gray-800 text-white py-4 mt-8">
        <div class="max-w-7xl mx-auto text-center">
            <p>&copy; {{ date('Y') }} HelpDeskly. All rights reserved.</p>
        </div>
    </footer>

</body>

</html>