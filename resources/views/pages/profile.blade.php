@extends('layouts.app')

@section('title', 'Profile - HelpDeskly')

@section('content')
    <div class="min-h-screen bg-gray-50 py-8">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="text-center mb-12">
                <h1 class="text-4xl font-bold text-gray-900 mb-4">Profile Settings</h1>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">Manage your account information, security settings, and
                    preferences</p>
            </div>

            <div class="space-y-8">
                <!-- Profile Card -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="bg-gradient-to-r from-blue-500 to-blue-600 px-8 py-6">
                        <div class="flex items-center space-x-6">
                            <!-- Avatar -->
                            <div class="relative">
                                <div
                                    class="w-20 h-20 bg-white/20 rounded-full flex items-center justify-center backdrop-blur-sm border-2 border-white/30">
                                    @if(Auth::user()->avatar)
                                        <img src="{{ asset('storage/' . Auth::user()->avatar) }}" alt="Profile"
                                            class="w-18 h-18 rounded-full object-cover">
                                    @else
                                        <span class="text-2xl font-bold text-white">
                                            {{ substr(Auth::user()->first_name, 0, 1) }}{{ substr(Auth::user()->last_name, 0, 1) }}
                                        </span>
                                    @endif
                                </div>
                                <div
                                    class="absolute -bottom-2 -right-2 w-8 h-8 bg-green-400 border-4 border-white rounded-full">
                                </div>
                            </div>

                            <!-- User Info -->
                            <div class="flex-1">
                                <h2 class="text-2xl font-bold text-white mb-1">
                                    {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}
                                </h2>
                                <p class="text-blue-100 flex items-center">
                                    <i class="fas fa-envelope mr-2"></i>
                                    {{ Auth::user()->email }}
                                </p>
                                <p class="text-blue-100 text-sm mt-2 flex items-center">
                                    <i class="fas fa-calendar-alt mr-2"></i>
                                    Joined {{ Auth::user()->created_at->format('M Y') }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Profile Form -->
                    <div class="p-8">
                        <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data"
                            class="space-y-6">
                            @csrf
                            @method('PUT')

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- First Name -->
                                <div>
                                    <label for="first_name"
                                        class="block text-sm font-semibold text-gray-700 mb-2 flex items-center">
                                        <i class="fas fa-user mr-2 text-blue-500"></i>
                                        First Name
                                    </label>
                                    <input id="first_name" name="first_name" type="text"
                                        value="{{ old('first_name', Auth::user()->first_name) }}"
                                        class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 bg-gray-50 hover:bg-white @error('first_name') border-red-300 bg-red-50 @enderror"
                                        required>
                                    @error('first_name')
                                        <p class="text-red-500 text-sm mt-2 flex items-center">
                                            <i class="fas fa-exclamation-circle mr-1"></i>
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>

                                <!-- Last Name -->
                                <div>
                                    <label for="last_name"
                                        class="block text-sm font-semibold text-gray-700 mb-2 flex items-center">
                                        <i class="fas fa-user mr-2 text-blue-500"></i>
                                        Last Name
                                    </label>
                                    <input id="last_name" name="last_name" type="text"
                                        value="{{ old('last_name', Auth::user()->last_name) }}"
                                        class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 bg-gray-50 hover:bg-white @error('last_name') border-red-300 bg-red-50 @enderror"
                                        required>
                                    @error('last_name')
                                        <p class="text-red-500 text-sm mt-2 flex items-center">
                                            <i class="fas fa-exclamation-circle mr-1"></i>
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>
                            </div>

                            <!-- Email -->
                            <div>
                                <label for="email" class="block text-sm font-semibold text-gray-700 mb-2 flex items-center">
                                    <i class="fas fa-envelope mr-2 text-blue-500"></i>
                                    Email Address
                                </label>
                                <input id="email" name="email" type="email" value="{{ old('email', Auth::user()->email) }}"
                                    class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 bg-gray-50 hover:bg-white @error('email') border-red-300 bg-red-50 @enderror"
                                    required>
                                @error('email')
                                    <p class="text-red-500 text-sm mt-2 flex items-center">
                                        <i class="fas fa-exclamation-circle mr-1"></i>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>
                            <!-- Phone Number -->
                            <div>
                                <label for="phone_number" class="block text-sm font-semibold text-gray-700 mb-2 flex items-center">
                                    <i class="fas fa-envelope mr-2 text-blue-500"></i>
                                    Phone Number
                                </label>
                                <input id="phone_number" name="phone_number" type="text" value="{{ old('phone_number', Auth::user()->phone_number) }}"
                                    class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 bg-gray-50 hover:bg-white @error('phone_number') border-red-300 bg-red-50 @enderror"
                                    nullable>
                                @error('phone_number')
                                    <p class="text-red-500 text-sm mt-2 flex items-center">
                                        <i class="fas fa-exclamation-circle mr-1"></i>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <!-- Avatar Upload -->
                            <div>
                                <label for="avatar"
                                    class="block text-sm font-semibold text-gray-700 mb-2 flex items-center">
                                    <i class="fas fa-camera mr-2 text-blue-500"></i>
                                    Profile Picture
                                </label>
                                <div class="flex items-center space-x-6">
                                    <div class="flex-shrink-0">
                                        <div
                                            class="w-16 h-16 bg-gradient-to-br from-blue-400 to-blue-600 rounded-full flex items-center justify-center text-white font-semibold text-lg">
                                            @if(Auth::user()->avatar)
                                                <img src="{{ asset('storage/' . Auth::user()->avatar) }}" alt="Current Avatar"
                                                    class="w-16 h-16 rounded-full object-cover">
                                            @else
                                                {{ substr(Auth::user()->first_name, 0, 1) }}{{ substr(Auth::user()->last_name, 0, 1) }}
                                            @endif
                                        </div>
                                    </div>
                                    <div class="flex-1">
                                        <input id="avatar" name="avatar" type="file"
                                            class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 bg-gray-50 hover:bg-white file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100"
                                            accept="image/*">
                                        <p class="text-sm text-gray-500 mt-2">JPG, PNG or GIF. Max 2MB.</p>
                                    </div>
                                </div>
                                @error('avatar')
                                    <p class="text-red-500 text-sm mt-2 flex items-center">
                                        <i class="fas fa-exclamation-circle mr-1"></i>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <!-- Submit Button -->
                            <div class="pt-4">
                                <button type="submit"
                                    class="w-full bg-gradient-to-r from-blue-500 to-blue-600 text-white py-4 px-6 rounded-xl hover:from-blue-600 hover:to-blue-700 focus:ring-4 focus:ring-blue-200 transition-all duration-200 font-semibold shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                                    <i class="fas fa-save mr-2"></i>
                                    Save Profile Changes
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- Danger Zone Card -->
                <div class="bg-white rounded-2xl shadow-sm border border-red-100 overflow-hidden">
                    <div class="border-b border-red-100 px-8 py-6 bg-red-50">
                        <h2 class="text-xl font-bold text-red-900 flex items-center">
                            <i class="fas fa-exclamation-triangle mr-3 text-red-500"></i>
                            Danger Zone
                        </h2>
                        <p class="text-red-700 text-sm mt-1">Irreversible and destructive actions</p>
                    </div>

                    <div class="p-8">
                        <div class="flex items-center justify-between">
                            <div class="flex-1">
                                <h3 class="text-lg font-semibold text-gray-900 mb-1">Delete Account</h3>
                                <p class="text-gray-600 text-sm">Once you delete your account, there is no going back.
                                    Please be certain.</p>
                            </div>
                            <button type="button" onclick="openDeleteModal()"
                                class="bg-red-500 text-white py-3 px-6 rounded-xl hover:bg-red-600 focus:ring-4 focus:ring-red-200 transition-all duration-200 font-semibold shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 whitespace-nowrap">
                                <i class="fas fa-trash mr-2"></i>
                                Delete Account
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div id="deleteModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4 z-50 hidden">
        <div class="bg-white rounded-2xl max-w-md w-full p-6 transform scale-95 transition-transform duration-200">
            <div class="text-center">
                <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-exclamation-triangle text-red-500 text-2xl"></i>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 mb-2">Delete Account</h3>
                <p class="text-gray-600 mb-6">
                    Are you sure you want to delete your account? This action cannot be undone and all your data will be
                    permanently lost.
                </p>
            </div>
            <div class="flex space-x-4">
                <button type="button" onclick="closeDeleteModal()"
                    class="flex-1 bg-gray-100 text-gray-700 py-3 px-4 rounded-xl hover:bg-gray-200 transition-all duration-200 font-semibold">
                    Cancel
                </button>
                <form method="POST" action="{{ route('profile.destroy') }}" class="flex-1">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="w-full bg-red-500 text-white py-3 px-4 rounded-xl hover:bg-red-600 focus:ring-4 focus:ring-red-200 transition-all duration-200 font-semibold">
                        Yes, Delete
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script>
        function openDeleteModal() {
            document.getElementById('deleteModal').classList.remove('hidden');
            setTimeout(() => {
                document.getElementById('deleteModal').classList.add('scale-100');
            }, 50);
        }

        function closeDeleteModal() {
            document.getElementById('deleteModal').classList.remove('scale-100');
            setTimeout(() => {
                document.getElementById('deleteModal').classList.add('hidden');
            }, 200);
        }

        // Password visibility toggle
        document.querySelectorAll('.toggle-password').forEach(icon => {
            icon.addEventListener('click', function () {
                const input = this.previousElementSibling;
                const type = input.getAttribute('type') === 'password' ? 'text' : 'password';
                input.setAttribute('type', type);
                this.classList.toggle('fa-eye-slash');
                this.classList.toggle('fa-eye');
            });
        });

        // Close modal when clicking outside
        document.getElementById('deleteModal').addEventListener('click', function (e) {
            if (e.target === this) {
                closeDeleteModal();
            }
        });
    </script>

    <style>
        .toggle-password:hover {
            color: #4f46e5;
        }
    </style>
@endsection