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

        <form method="POST" action="{{ route('login.post') }}">
            @csrf

            <!-- Email Address -->
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                    <i class="fas fa-envelope text-gray-400 mr-2"></i>Email Address
                </label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                    autocomplete="email"
                    class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 @error('email') border-red-500 @enderror"
                    placeholder="Enter your email">
                @error('email')
                @enderror
            </div>

            <!-- Password -->
            <div class="mb-6">
                <div class="flex items-center justify-between mb-2">
                    <label for="password" class="block text-sm font-medium text-gray-700">
                        <i class="fas fa-lock text-gray-400 mr-2"></i>Password
                    </label>
                    <a href="{{ route('forgot-password.get') }}" class="text-sm text-blue-600 hover:text-blue-500 transition duration-200">
                        Forgot password?
                    </a>
                </div>
                <input id="password" type="password" name="password" required autocomplete="current-password"
                    class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 @error('password') border-red-500 @enderror"
                    placeholder="Enter your password">
                @error('password')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Submit Button -->
            <button type="submit"
                class="w-full bg-blue-600 text-white py-3 px-4 rounded-lg hover:bg-blue-700 focus:ring-4 focus:ring-blue-200 transition duration-200 font-semibold cursor-pointer">
                <i class="fas fa-sign-in-alt mr-2"></i>Sign In
            </button>
        </form>
    </div>
@endsection

@section('auth-links')
    <p>Don't have an account?
        <a href="{{ route('register') }}" class="text-blue-600 hover:text-blue-500 font-medium transition duration-200">
            Create one here
        </a>
    </p>
@endsection