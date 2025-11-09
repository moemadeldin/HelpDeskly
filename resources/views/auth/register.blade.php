@extends('auth.layouts.auth')

@section('title', 'Register - HelpDeskly')

@section('content')
<div class="p-8">
    <h2 class="text-2xl font-bold text-gray-800 text-center mb-2">Create Account</h2>
    <p class="text-gray-600 text-center mb-8">Join HelpDeskly and streamline your support process</p>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Full Name -->
        <x-auth.input
            id="first_name" 
            name="first_name"
            label="First Name" 
            icon="fas fa-user" 
            :error="$errors->first('first_name')" 
            value="{{ old('first_name') }}" 
            required 
            autofocus 
            autocomplete="first_name"
        />
        <x-auth.input
            id="last_name" 
            name="last_name"
            label="Last Name" 
            icon="fas fa-user" 
            :error="$errors->first('last_name')" 
            value="{{ old('last_name') }}" 
            required 
            autofocus 
            autocomplete="last_name"
        />

        <!-- Email Address -->
        <x-auth.input
            id="email" 
            name="email"
            type="email" 
            label="Email Address" 
            icon="fas fa-envelope" 
            :error="$errors->first('email')" 
            value="{{ old('email') }}" 
            required 
            autocomplete="email"
        />
        <x-auth.input
            id="phone_number" 
            name="phone_number"
            label="Phone Number" 
            icon="fas fa-phone" 
            :error="$errors->first('phone_number')" 
            value="{{ old('phone_number') }}" 
            required 
            autofocus 
            autocomplete="phone_number"
        />
        <!-- Password -->
        <x-auth.input
            id="password" 
            name="password"
            type="password" 
            label="Password" 
            icon="fas fa-lock" 
            :error="$errors->first('password')" 
            required 
            autocomplete="new-password"
        />

        <!-- Confirm Password -->
        <x-auth.input
            id="password_confirmation" 
            name="password_confirmation"
            type="password" 
            label="Confirm Password" 
            icon="fas fa-lock" 
            :error="$errors->first('password_confirmation')" 
            required 
            autocomplete="new-password"
        />

        <!-- Terms Agreement -->
        <div class="flex items-center mb-6">
            <input 
                id="terms" 
                type="checkbox" 
                name="terms"
                required
                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2"
            >
            <label for="terms" class="ml-2 text-sm text-gray-600">
                I agree to the <a href="#" class="text-blue-600 hover:text-blue-500">Terms of Service</a> and <a href="#" class="text-blue-600 hover:text-blue-500">Privacy Policy</a>
            </label>
        </div>

        <!-- Submit Button -->
        <button type="submit" class="w-full bg-blue-600 text-white py-3 px-4 rounded-lg hover:bg-blue-700 focus:ring-4 focus:ring-blue-200 transition duration-200 font-semibold cursor-pointer">
            <i class="fas fa-user-plus mr-2"></i>Create Account
        </button>
    </form>

    <!-- Role Information -->
    <div class="mt-6 p-4 bg-blue-50 rounded-lg">
        <p class="text-sm text-blue-800 text-center mb-3 font-medium">Account Types:</p>
        <div class="space-y-2 text-xs text-blue-700">
            <div class="flex items-center">
                <i class="fas fa-shield-alt mr-2"></i>
                <span><strong>Admin:</strong> Full system access & team management</span>
            </div>
            <div class="flex items-center">
                <i class="fas fa-headset mr-2"></i>
                <span><strong>Agent:</strong> Ticket management & customer support</span>
            </div>
            <div class="flex items-center">
                <i class="fas fa-users mr-2"></i>
                <span><strong>Customer:</strong> Submit tickets & track requests</span>
            </div>
        </div>
    </div>
</div>
@endsection

@section('auth-links')
    <p>Already have an account? 
        <a href="{{ route('login') }}" class="text-blue-600 hover:text-blue-500 font-medium transition duration-200">
            Sign in here
        </a>
    </p>
@endsection
