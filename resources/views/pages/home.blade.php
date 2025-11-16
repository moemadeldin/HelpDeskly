@extends('layouts.app')

@section('title', 'Home - HelpDeskly')

@section('content')
    <div class="p-8">
        <h1 class="text-3xl font-bold text-gray-800 text-center mb-4">Welcome to HelpDeskly</h1>
        <p class="text-gray-600 text-center mb-8">Streamline your support process and manage tickets seamlessly.</p>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Ticket Management Section -->
            <div class="bg-white p-6 rounded-lg shadow-lg hover:shadow-xl transition-shadow duration-200">
                <h3 class="text-xl font-semibold text-gray-800 mb-4">Ticket Management</h3>
                <p class="text-gray-600 mb-4">Manage support tickets from customers, assign agents, and track progress.</p>
                <a href="{{ route('tickets.index') }}"
                    class="text-blue-600 hover:text-blue-500 font-medium transition duration-200">View Tickets</a>
            </div>

            <!-- Knowledge Base Section -->
            <div class="bg-white p-6 rounded-lg shadow-lg hover:shadow-xl transition-shadow duration-200">
                <h3 class="text-xl font-semibold text-gray-800 mb-4">Knowledge Base</h3>
                <p class="text-gray-600 mb-4">Access helpful articles and FAQs to assist customers and agents.</p>
                <a href="#}" class="text-blue-600 hover:text-blue-500 font-medium transition duration-200">Explore Knowledge
                    Base</a>
            </div>

            <!-- User Profile Section -->
            <div class="bg-white p-6 rounded-lg shadow-lg hover:shadow-xl transition-shadow duration-200">
                <h2 class="text-2xl font-semibold text-gray-800 mb-4">Recent Activity</h2>
                <ul class="space-y-4">
                    <li class="flex items-center">
                        <i class="fas fa-ticket-alt text-blue-600 mr-3"></i>
                        <span class="text-gray-700">New support ticket opened by John Doe.</span>
                    </li>
                    <li class="flex items-center">
                        <i class="fas fa-comment-dots text-green-600 mr-3"></i>
                        <span class="text-gray-700">Ticket #112 was updated with a new response.</span>
                    </li>
                    <li class="flex items-center">
                        <i class="fas fa-user-cog text-yellow-600 mr-3"></i>
                        <span class="text-gray-700">Your account settings were updated successfully.</span>
                    </li>
                </ul>
            </div>
        </div>
        <!-- Support Resources -->
        {{-- <div class="mt-8 p-6 bg-blue-50 rounded-lg">
            <h2 class="text-2xl font-semibold text-blue-800 mb-4">Support Resources</h2>
            <p class="text-blue-700 mb-4">Need help? Check out our support resources or contact us directly.</p>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                <div class="bg-white p-6 rounded-lg shadow-lg">
                    <h4 class="text-lg font-semibold text-gray-800 mb-3">FAQs</h4>
                    <p class="text-gray-600 mb-4">Find answers to the most common questions.</p>
                    <a href="#" class="text-blue-600 hover:text-blue-500 font-medium transition duration-200">Browse
                        FAQs</a>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-lg">
                    <h4 class="text-lg font-semibold text-gray-800 mb-3">Help Center</h4>
                    <p class="text-gray-600 mb-4">Get detailed assistance on how to use HelpDeskly.</p>
                    <a href="#" class="text-blue-600 hover:text-blue-500 font-medium transition duration-200">Visit Help
                        Center</a>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-lg">
                    <h4 class="text-lg font-semibold text-gray-800 mb-3">Contact Support</h4>
                    <p class="text-gray-600 mb-4">Reach out to our support team for more assistance.</p>
                    <a href="#" class="text-blue-600 hover:text-blue-500 font-medium transition duration-200">Contact Us</a>
                </div>
            </div>
        </div> --}}
    </div>
@endsection