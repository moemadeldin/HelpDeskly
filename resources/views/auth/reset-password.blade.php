@extends('auth.layouts.auth')

@section('title', 'Reset Password - HelpDeskly')

@section('content')
    <div class="p-8">
        <h2 class="text-2xl font-bold text-gray-800 text-center mb-2">Reset Password</h2>
        <p class="text-gray-600 text-center mb-8">Enter your verification code and new password</p>

        <form method="POST" action="{{ route('reset-password.post') }}">
            @csrf

            <!-- Email (pre-filled if available) -->
            <x-auth.input id="email" name="email" type="email" label="Email" icon="fas fa-envelope"
                :error="$errors->first('email')" value="{{ $email ?? old('email') }}" required autocomplete="email" />

            <!-- Verification Code -->
            <x-auth.input id="verification_code" name="verification_code" type="text" label="Verification Code"
                icon="fas fa-shield-alt" :error="$errors->first('verification_code')" required
                placeholder="Enter the 6-digit code from your email" />

            <!-- New Password -->
            <x-auth.input id="new_password" name="new_password" type="password" label="New Password" icon="fas fa-lock"
                :error="$errors->first('new_password')" required autocomplete="new-password" />

            <!-- Confirm New Password -->
            <x-auth.input id="new_password_confirmation" name="new_password_confirmation" type="password"
                label="Confirm New Password" icon="fas fa-lock" :error="$errors->first('new_password_confirmation')" required
                autocomplete="new-password" />

            <!-- Submit Button -->
            <button type="submit"
                class="w-full bg-blue-600 text-white py-3 px-4 rounded-lg hover:bg-blue-700 focus:ring-4 focus:ring-blue-200 transition duration-200 font-semibold cursor-pointer">
                <i class="fas fa-redo mr-2"></i>Reset Password
            </button>
        </form>
    </div>
@endsection