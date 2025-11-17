<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body class="bg-gray-100">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <x-dashboard.side-bar />

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Header -->
            <x-dashboard.header />

            <!-- Main Content -->
            <main class="flex-1 overflow-y-auto p-6">
                <!-- Analytics Section -->
                <div class="mb-8">
                    <h1 class="text-2xl font-bold text-gray-800 mb-6">Dashboard Analytics</h1>
                    @if(auth()->user()->isAgent())
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                            <!-- Total Tickets -->
                            <div class="bg-white rounded-lg shadow p-6 border-l-4 border-blue-500">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <p class="text-sm font-medium text-gray-600">Total Tickets</p>
                                        <p class="text-2xl font-bold text-gray-800">{{ $agentTotalTickets }}</p>
                                    </div>
                                    <div class="bg-blue-100 p-3 rounded-full">
                                        <i class="fas fa-ticket-alt text-blue-500 text-xl"></i>
                                    </div>
                                </div>
                            </div>

                            <!-- Total Users -->
                            <div class="bg-white rounded-lg shadow p-6 border-l-4 border-green-500">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <p class="text-sm font-medium text-gray-600">Total Solved Tickets</p>
                                        <p class="text-2xl font-bold text-gray-800">{{ $agentTotalResolvedTickets }}</p>
                                    </div>
                                    <div class="bg-green-100 p-3 rounded-full">
                                        <i class="fas fa-users text-green-500 text-xl"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                    @if(auth()->user()->isAdmin())
                            <!-- Stats Grid -->
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                                <!-- Total Tickets -->
                                <div class="bg-white rounded-lg shadow p-6 border-l-4 border-blue-500">
                                    <div class="flex items-center justify-between">
                                        <div>
                                            <p class="text-sm font-medium text-gray-600">Total Tickets</p>
                                            <p class="text-2xl font-bold text-gray-800">{{ $totalTickets }}</p>
                                        </div>
                                        <div class="bg-blue-100 p-3 rounded-full">
                                            <i class="fas fa-ticket-alt text-blue-500 text-xl"></i>
                                        </div>
                                    </div>
                                </div>

                                <!-- Total Users -->
                                <div class="bg-white rounded-lg shadow p-6 border-l-4 border-green-500">
                                    <div class="flex items-center justify-between">
                                        <div>
                                            <p class="text-sm font-medium text-gray-600">Total Customers</p>
                                            <p class="text-2xl font-bold text-gray-800">{{ $totalCustomers }}</p>
                                        </div>
                                        <div class="bg-green-100 p-3 rounded-full">
                                            <i class="fas fa-users text-green-500 text-xl"></i>
                                        </div>
                                    </div>
                                </div>

                                <!-- Total Agents -->
                                <div class="bg-white rounded-lg shadow p-6 border-l-4 border-purple-500">
                                    <div class="flex items-center justify-between">
                                        <div>
                                            <p class="text-sm font-medium text-gray-600">Total Agents</p>
                                            <p class="text-2xl font-bold text-gray-800">{{ $totalAgents }}</p>
                                        </div>
                                        <div class="bg-purple-100 p-3 rounded-full">
                                            <i class="fas fa-user-shield text-purple-500 text-xl"></i>
                                        </div>
                                    </div>
                                </div>

                                <!-- Online Users -->
                                <div class="bg-white rounded-lg shadow p-6 border-l-4 border-yellow-500">
                                    <div class="flex items-center justify-between">
                                        <div>
                                            <p class="text-sm font-medium text-gray-600">Online Customers</p>
                                            <p class="text-2xl font-bold text-gray-800">{{ $onlineCustomers }}</p>
                                        </div>
                                        <div class="bg-yellow-100 p-3 rounded-full">
                                            <i class="fas fa-wifi text-yellow-500 text-xl"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Second Row -->
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                                <!-- Online Agents -->
                                <div class="bg-white rounded-lg shadow p-6 border-l-4 border-indigo-500">
                                    <div class="flex items-center justify-between">
                                        <div>
                                            <p class="text-sm font-medium text-gray-600">Online Agents</p>
                                            <p class="text-2xl font-bold text-gray-800">{{ $onlineAgents }}</p>
                                        </div>
                                        <div class="bg-indigo-100 p-3 rounded-full">
                                            <i class="fas fa-user-check text-indigo-500 text-xl"></i>
                                        </div>
                                    </div>
                                </div>

                                <!-- Resolved Tickets -->
                                <div class="bg-white rounded-lg shadow p-6 border-l-4 border-green-500">
                                    <div class="flex items-center justify-between">
                                        <div>
                                            <p class="text-sm font-medium text-gray-600">Resolved Tickets</p>
                                            <p class="text-2xl font-bold text-gray-800">{{ $resolvedTickets }}</p>
                                        </div>
                                        <div class="bg-green-100 p-3 rounded-full">
                                            <i class="fas fa-check-circle text-green-500 text-xl"></i>
                                        </div>
                                    </div>
                                </div>

                                <!-- Closed Tickets -->
                                <div class="bg-white rounded-lg shadow p-6 border-l-4 border-gray-500">
                                    <div class="flex items-center justify-between">
                                        <div>
                                            <p class="text-sm font-medium text-gray-600">Closed Tickets</p>
                                            <p class="text-2xl font-bold text-gray-800">{{ $closedTickets }}</p>
                                        </div>
                                        <div class="bg-gray-100 p-3 rounded-full">
                                            <i class="fas fa-times-circle text-gray-500 text-xl"></i>
                                        </div>
                                    </div>
                                </div>

                                <!-- In Progress Tickets -->
                                <div class="bg-white rounded-lg shadow p-6 border-l-4 border-orange-500">
                                    <div class="flex items-center justify-between">
                                        <div>
                                            <p class="text-sm font-medium text-gray-600">In Progress</p>
                                            <p class="text-2xl font-bold text-gray-800">{{ $inProgressTickets }}</p>
                                        </div>
                                        <div class="bg-orange-100 p-3 rounded-full">
                                            <i class="fas fa-spinner text-orange-500 text-xl"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @yield('content')
            </main>
        </div>
    </div>
</body>

</html>