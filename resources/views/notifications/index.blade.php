@extends('layouts.app')

@section('title', 'Notifications - HelpDeskly')

@section('content')
    <div class="py-8 px-4 sm:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto">
            <!-- Header -->
            <div class="bg-white shadow-lg rounded-lg p-6 mb-6">
                <div class="flex justify-between items-center">
                    <h1 class="text-2xl font-bold text-gray-800">Notifications</h1>
                    @if($notifications->count() > 0)
                        <form action="{{ route('notifications.mark-all-read') }}" method="POST">
                            @csrf
                            <button type="submit"
                                class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors">
                                Mark All as Read
                            </button>
                        </form>
                    @endif
                </div>
            </div>

            <!-- Notifications List -->
            <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                @if($notifications->count() > 0)
                    <div class="divide-y divide-gray-200">
                        @foreach($notifications as $notification)
                            <div class="p-6 hover:bg-gray-50 transition-colors notification-item 
                                                            {{ $notification->unread() ? 'bg-blue-50 border-l-4 border-blue-500' : '' }}"
                                data-notification-id="{{ $notification->id }}">
                                <div class="flex justify-between items-start">
                                    <div class="flex-1">
                                        <div class="flex items-start space-x-3">
                                            @if($notification->unread())
                                                <div class="mt-1 w-2 h-2 bg-blue-500 rounded-full flex-shrink-0"></div>
                                            @else
                                                <div class="mt-1 w-2 h-2 bg-gray-300 rounded-full flex-shrink-0"></div>
                                            @endif
                                            <div class="flex-1">
                                                <p class="text-gray-800">
                                                    {{ $notification->data['message'] ?? 'Notification' }}
                                                </p>
                                                <div class="flex items-center space-x-4 mt-2">
                                                    <span class="text-sm text-gray-500">
                                                        <i class="fas fa-clock mr-1"></i>
                                                        {{ $notification->created_at->diffForHumans() }}
                                                    </span>
                                                    @if(isset($notification->data['url']))
                                                        <a href="{{ $notification->data['url'] }}"
                                                            class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                                                            View Details
                                                        </a>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flex space-x-2 ml-4">
                                        @if($notification->unread())
                                            <form action="{{ route('notifications.mark-as-read', $notification->id) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="text-green-600 hover:text-green-800 text-sm font-medium"
                                                    title="Mark as read">
                                                    <i class="fas fa-check"></i>
                                                </button>
                                            </form>
                                        @endif
                                        <form action="{{ route('notifications.destroy', $notification->id) }}" method="POST"
                                            onsubmit="return confirm('Are you sure you want to delete this notification?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-800 text-sm font-medium"
                                                title="Delete notification">
                                                <i class="fas fa-trash"></i>
                                                Delete
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Pagination -->
                    <div class="bg-white px-4 py-3 border-t border-gray-200 sm:px-6">
                        {{ $notifications->links() }}
                    </div>
                @else
                    <!-- Empty State -->
                    <div class="text-center py-12">
                        <i class="fas fa-bell-slash text-4xl text-gray-400 mb-4"></i>
                        <h3 class="text-lg font-medium text-gray-900 mb-2">No notifications</h3>
                        <p class="text-gray-500">You don't have any notifications yet.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Mark as read when clicking on unread notifications
            document.querySelectorAll('.notification-item.bg-blue-50').forEach(item => {
                item.addEventListener('click', function (e) {
                    // Don't trigger if clicking delete button or links
                    if (e.target.tagName === 'BUTTON' || e.target.tagName === 'A' || e.target.closest('button') || e.target.closest('a')) {
                        return;
                    }

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
                                    this.classList.remove('bg-blue-50', 'border-l-4', 'border-blue-500');
                                    const dot = this.querySelector('.bg-blue-500');
                                    if (dot) dot.classList.replace('bg-blue-500', 'bg-gray-300');
                                }
                            });
                    }
                });
            });
        });
    </script>
@endpush