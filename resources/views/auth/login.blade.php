@extends('auth.layouts.auth')

@section('title', 'Login - HelpDeskly')

@section('content')
<div class="p-8">
    <h2 class="text-2xl font-bold text-gray-800 text-center mb-2">Welcome Back</h2>
    <p class="text-gray-600 text-center mb-8">Sign in to your HelpDeskly account</p>

    <!-- Session Status -->
    @if (session('status'))
        <div class="mb-4 text-sm text-green-600 bg-green-50 p-3 rounded-lg">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div class="mb-4">
            <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                <i class="fas fa-envelope text-gray-400 mr-2"></i>Email Address
            </label>
            <input 
                id="email" 
                type="email" 
                name="email" 
                value="{{ old('email') }}" 
                required 
                autofocus 
                autocomplete="email"
                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 @error('email') border-red-500 @enderror"
                placeholder="Enter your email"
            >
            @error('email')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Password -->
        <div class="mb-6">
            <div class="flex items-center justify-between mb-2">
                <label for="password" class="block text-sm font-medium text-gray-700">
                    <i class="fas fa-lock text-gray-400 mr-2"></i>Password
                </label>
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="text-sm text-blue-600 hover:text-blue-500 transition duration-200">
                        Forgot password?
                    </a>
                @endif
            </div>
            <input 
                id="password" 
                type="password" 
                name="password" 
                required 
                autocomplete="current-password"
                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 @error('password') border-red-500 @enderror"
                placeholder="Enter your password"
            >
            @error('password')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Remember Me -->
        <div class="flex items-center mb-6">
            <input 
                id="remember_me" 
                type="checkbox" 
                name="remember"
                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2"
            >
            <label for="remember_me" class="ml-2 text-sm text-gray-600">Remember me</label>
        </div>

        <!-- Submit Button -->
        <button type="submit" class="w-full bg-blue-600 text-white py-3 px-4 rounded-lg hover:bg-blue-700 focus:ring-4 focus:ring-blue-200 transition duration-200 font-semibold">
            <i class="fas fa-sign-in-alt mr-2"></i>Sign In
        </button>
    </form>

    <!-- Demo Credentials (Remove in production) -->
    <div class="mt-6 p-4 bg-gray-50 rounded-lg">
        <p class="text-sm text-gray-600 text-center mb-2 font-medium">Demo Credentials:</p>
        <div class="grid grid-cols-2 gap-2 text-xs">
            <div class="text-center">
                <span class="font-medium">Admin:</span>
                <p>admin@helpdeskly.com</p>
                <p>password: secret</p>
            </div>
            <div class="text-center">
                <span class="font-medium">Agent:</span>
                <p>agent@helpdeskly.com</p>
                <p>password: secret</p>
            </div>
        </div>
    </div>
</div>
@endsection

@section('auth-links')
    <p>Don't have an account? 
        <a href="{{ route('register') }}" class="text-blue-600 hover:text-blue-500 font-medium transition duration-200">
            Create one here
        </a>
    </p>
@endsection