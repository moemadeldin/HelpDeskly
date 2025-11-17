@extends('auth.layouts.auth')

@section('title', 'Forgot Password - HelpDeskly')

@section('content')
    <div class="p-8">
        <h2 class="text-2xl font-bold text-gray-800 text-center mb-2">Reset Your Password</h2>
        <p class="text-gray-600 text-center mb-8">Enter your email to receive a password reset link</p>

        <form method="POST" action="{{ route('forgot-password.post') }}">
            @csrf
            <!-- Email Address -->
            <x-auth.input id="email" name="email" type="email" label="Email Address" icon="fas fa-envelope"
                :error="$errors->first('email')" value="{{ old('email') }}" required autocomplete="email" />

            <!-- Submit Button -->
            <button type="submit"
                class="w-full bg-blue-600 text-white py-3 px-4 rounded-lg hover:bg-blue-700 focus:ring-4 focus:ring-blue-200 transition duration-200 font-semibold cursor-pointer">
                <i class="fas fa-paper-plane mr-2"></i>Send Reset Link
            </button>
        </form>
    </div>
@endsection

@section('auth-links')
    <p>Remember your password?
        <a href="{{ route('login.get') }}" class="text-blue-600 hover:text-blue-500 font-medium transition duration-200">
            Sign in here
        </a>
    </p>
@endsection