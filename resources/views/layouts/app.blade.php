<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <title>@yield('title', 'HelpDeskly')</title>
    <!-- Include TailwindCSS or your preferred CSS framework -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a076d05399.js"></script> <!-- For icons -->
</head>

<body class="bg-gray-100">

    <!-- Navigation -->
    <nav class="bg-blue-600 text-white py-4">
        <div class="max-w-7xl mx-auto px-6">
            <div class="flex justify-between items-center">
                <div class="flex items-center">
                    <a href={{ route('home') }} class="text-xl font-bold">HelpDeskly</a>
                </div>
                @if(Auth::check())
                    <div class="flex items-center space-x-6">
                        <!-- Notifications Bell -->
                        <div class="relative">
                        <button id="notifications-btn"
                                class="relative p-2 text-white hover:text-blue-200 transition-colors">
                                <i class="fas fa-bell text-lg"></i>
                                @php
                                    $unreadCount = auth()->user()->unreadNotifications->count();
                                @endphp
                                @if($unreadCount > 0)
                                    <span id="notification-count"
                                        class="absolute -top-1 -right-1 bg-red-500 text-white rounded-full text-xs w-5 h-5 flex items-center justify-center">
                                        {{ $unreadCount > 9 ? '9+' : $unreadCount }}
                                    </span>
                                @else
                                    <span id="notification-count"
                                        class="absolute -top-1 -right-1 bg-red-500 text-white rounded-full text-xs w-5 h-5 flex items-center justify-center opacity-0">
                                        0
                                    </span>
                                @endif
                            </button>

                            <!-- Notifications Dropdown -->
                            <div id="notifications-dropdown"
                                class="absolute right-0 mt-2 w-80 bg-white rounded-lg shadow-lg border hidden z-50">
                                <div class="p-4 border-b bg-gray-50">
                                    <div class="flex justify-between items-center">
                                        <h3 class="font-semibold text-gray-800">Notifications</h3>
                                        @if($unreadCount > 0)
                                            <button id="mark-all-read" class="text-blue-600 text-sm hover:text-blue-800">
                                                Mark all as read
                                            </button>
                                        @endif
                                    </div>
                                </div>
                                <div id="notifications-list" class="max-h-96 overflow-y-auto">
                                    @forelse(auth()->user()->notifications->take(10) as $notification)
                                        <div class="p-3 border-b hover:bg-gray-50 notification-item {{ $notification->unread() ? 'bg-blue-50' : '' }}"
                                            data-notification-id="{{ $notification->id }}">
                                            <div class="flex justify-between items-start">
                                                <div class="flex-1">
                                                    <p class="text-sm text-gray-800">
                                                        {{ $notification->data['message'] ?? 'New notification' }}</p>
                                                    <p class="text-xs text-gray-500 mt-1">
                                                        {{ $notification->created_at->diffForHumans() }}
                                                    </p>
                                                </div>
                                                @if($notification->unread())
                                                    <span class="ml-2 w-2 h-2 bg-blue-500 rounded-full"></span>
                                                @endif
                                            </div>
                                        </div>
                                    @empty
                                        <div class="p-4 text-center text-gray-500">
                                            <i class="fas fa-bell-slash text-2xl mb-2"></i>
                                            <p>No notifications yet</p>
                                        </div>
                                    @endforelse
                                </div>
                                <div class="p-3 border-t bg-gray-50 text-center">
                                    <a href="{{ route('notifications.index') }}"
                                        class="text-blue-600 text-sm hover:text-blue-800 font-medium">
                                        View All Notifications
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- User Menu -->
                        <div class="flex items-center space-x-4">
                            <a href="{{ route('profile.index') }}" class="hover:text-blue-200 transition-colors">
                                {{ Auth::user()->first_name ?? 'Guest' }}
                            </a>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button class="hover:text-blue-200 transition-colors">Logout</button>
                            </form>
                        </div>
                    </div>
                @else
                    <div class="space-x-4">
                        <a href="{{ route('login.get') }}" class="hover:text-blue-200 transition-colors">Login</a>
                        <a href="{{ route('register') }}" class="hover:text-blue-200 transition-colors">Register</a>
                    </div>
                @endif
            </div>
        </div>
    </nav>

    <!-- Page Content -->
    <div class="min-h-screen">
        @yield('content') <!-- This is where page-specific content will go -->
    </div>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-4 mt-8">
        <div class="max-w-7xl mx-auto text-center">
            <p>&copy; {{ date('Y') }} HelpDeskly. All rights reserved.</p>
        </div>
    </footer>

    <!-- Notification Scripts -->
    @stack('scripts')

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const notificationsBtn = document.getElementById('notifications-btn');
            const notificationsDropdown = document.getElementById('notifications-dropdown');
            const markAllReadBtn = document.getElementById('mark-all-read');

            // Toggle notifications dropdown
            if (notificationsBtn) {
                notificationsBtn.addEventListener('click', function (e) {
                    e.stopPropagation();
                    notificationsDropdown.classList.toggle('hidden');
                });
            }

            // Close dropdown when clicking outside
            document.addEventListener('click', function () {
                notificationsDropdown.classList.add('hidden');
            });

            // Prevent dropdown from closing when clicking inside
            notificationsDropdown.addEventListener('click', function (e) {
                e.stopPropagation();
            });

            // Mark all as read
            if (markAllReadBtn) {
                markAllReadBtn.addEventListener('click', function () {
                    fetch('{{ route("notifications.mark-all-read") }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        }
                    })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                // Update UI
                                document.querySelectorAll('.notification-item').forEach(item => {
                                    item.classList.remove('bg-blue-50');
                                    const dot = item.querySelector('.bg-blue-500');
                                    if (dot) dot.remove();
                                });

                                // Update count
                                const countBadge = document.getElementById('notification-count');
                                countBadge.classList.add('hidden');
                                countBadge.textContent = '0';

                                // Hide mark all button
                                markAllReadBtn.remove();
                            }
                        });
                });
            }

            // Mark single notification as read
            document.querySelectorAll('.notification-item').forEach(item => {
                item.addEventListener('click', function () {
                    const notificationId = this.dataset.notificationId;
                    if (this.classList.contains('bg-blue-50')) {
                        fetch(`/notifications/${notificationId}/read`, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            }
                        })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    this.classList.remove('bg-blue-50');
                                    const dot = this.querySelector('.bg-blue-500');
                                    if (dot) dot.remove();

                                    // Update count
                                    const countBadge = document.getElementById('notification-count');
                                    let currentCount = parseInt(countBadge.textContent);
                                    if (currentCount > 1) {
                                        countBadge.textContent = currentCount - 1;
                                    } else {
                                        countBadge.classList.add('hidden');
                                        if (markAllReadBtn) markAllReadBtn.remove();
                                    }
                                }
                            });
                    }

                    // Navigate to notification URL if available
                    const url = this.querySelector('a')?.href;
                    if (url) {
                        window.location.href = url;
                    }
                });
            });

            // Real-time notifications with Echo (if configured)
            @if(config('broadcasting.default') !== 'log')
                if (typeof Echo !== 'undefined') {
                    Echo.private('users.{{ auth()->id() }}')
                        .notification((notification) => {
                            console.log('New notification received:', notification);
                            showNewNotification(notification);
                        });
                }
            @endif

                function showNewNotification(notification) {
                    // Show toast notification
                    const toast = document.createElement('div');
                    toast.className = 'fixed top-4 right-4 bg-white border-l-4 border-blue-500 p-4 rounded-lg shadow-lg z-50 max-w-sm';
                    toast.innerHTML = `
                <div class="flex items-start">
                    <i class="fas fa-bell text-blue-500 mt-1 mr-3"></i>
                    <div class="flex-1">
                        <div class="font-semibold text-gray-800 text-sm">New Notification</div>
                        <div class="text-gray-600 text-sm mt-1">${notification.message || 'You have a new notification'}</div>
                        ${notification.url ? `<a href="${notification.url}" class="text-blue-600 text-xs mt-2 inline-block">View</a>` : ''}
                    </div>
                    <button onclick="this.parentElement.remove()" class="text-gray-400 hover:text-gray-600 ml-2">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            `;
                    document.body.appendChild(toast);

                    // Auto remove after 5 seconds
                    setTimeout(() => {
                        if (toast.parentElement) {
                            toast.remove();
                        }
                    }, 5000);

                    // Update notification count
                    updateNotificationCount();
                }

            function updateNotificationCount() {
                const countBadge = document.getElementById('notification-count');
                let currentCount = parseInt(countBadge.textContent) || 0;
                countBadge.textContent = currentCount + 1;
                countBadge.classList.remove('hidden');
            }
        });
    </script>

</body>

</html>