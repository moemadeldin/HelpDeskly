@extends('layouts.app')

@section('title', 'Ticket #' . $ticket->id . ' - HelpDeskly')

@section('content')
    <div class="py-8 px-4 sm:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto">
            <!-- Ticket Header -->
            <div class="bg-white shadow-lg rounded-lg mb-6">
                <div class="px-6 py-4 border-b border-gray-200">
                    <div class="flex justify-between items-start">
                        <div>
                            <h1 class="text-2xl font-bold text-gray-800">{{ $ticket->subject }}</h1>
                            <p class="text-gray-600 mt-1">Ticket #{{ $ticket->id }}</p>
                        </div>
                        <div class="flex space-x-2">
                            <span class="px-3 py-1 rounded-full text-sm font-semibold 
                                                        @if($ticket->priority->value === 'high') bg-red-100 text-red-800
                                                        @elseif($ticket->priority->value === 'medium') bg-yellow-100 text-yellow-800
                                                        @else bg-green-100 text-green-800 @endif">
                                {{ ucfirst($ticket->priority->value) }} Priority
                            </span>
                            <span class="px-3 py-1 rounded-full text-sm font-semibold 
                                                        @if($ticket->status->value === 'open') bg-green-100 text-green-800
                                                        @elseif($ticket->status->value === 'in_progress') bg-blue-100 text-blue-800
                                                        @elseif($ticket->status->value === 'resolved') bg-gray-100 text-gray-800
                                                        @else bg-red-100 text-red-800 @endif">
                                {{ ucfirst(str_replace('_', ' ', $ticket->status->value)) }}
                            </span>
                        </div>
                    </div>
                </div>
                <div class="px-6 py-4">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-sm">
                        <div>
                            <span class="font-medium text-gray-700">Category:</span>
                            <span class="text-gray-600 ml-2">{{ $ticket->category->name }}</span>
                        </div>
                        <div>
                            <span class="font-medium text-gray-700">Created:</span>
                            <span class="text-gray-600 ml-2">{{ $ticket->created_at->format('F d, Y \a\t h:i A') }}</span>
                        </div>
                        <div>
                            <span class="font-medium text-gray-700">Last Updated:</span>
                            <span class="text-gray-600 ml-2">{{ $ticket->updated_at->format('F d, Y \a\t h:i A') }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Main Content -->
                <div class="lg:col-span-2">
                    <!-- Description -->
                    <div class="bg-white shadow-lg rounded-lg p-6 mb-6">
                        <h2 class="text-lg font-semibold text-gray-800 mb-4">Description</h2>
                        <div class="prose max-w-none text-gray-700">
                            {!! nl2br(e($ticket->description)) !!}
                        </div>
                    </div>

                    <!-- Attachments -->
                    @if($ticket->attachments->count() > 0)
                        <div class="bg-white shadow-lg rounded-lg p-6 mb-6">
                            <h2 class="text-lg font-semibold text-gray-800 mb-4">Attachments</h2>
                            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                                @foreach($ticket->attachments as $attachment)
                                    @php
                                        $extension = pathinfo($attachment->name, PATHINFO_EXTENSION);
                                        $isImage = in_array(strtolower($extension), ['jpg', 'jpeg', 'png', 'gif', 'webp']);
                                    @endphp
                                          @if($isImage)
                                            <div class="text-center">
                                                <img src="{{ asset('storage/' . $attachment->path) }}" alt="{{ $attachment->name }}"
                                                     class="w-full h-32 object-cover rounded-lg border cursor-pointer"
                                                    onclick="window.open('{{ $attachment->url }}', '_blank')">
                                                <p class="text-sm mt-2 truncate">{{ $attachment->name }}</p>
                                            </div>
                                        @else
                                            <div class="flex items-center p-3 border rounded-lg">
                                                <i class="fas fa-file mr-3"></i>
                                                    <div class="flex-1 min-w-0">
                                                        <a href="{{ $attachment->url }}" download="{{ $attachment->name }}"
                                                            class="font-medium truncate text-blue-600 hover:text-blue-800 hover:underline">
                                                            {{ $attachment->name }}
                                                        </a>
                                                        <p class="text-sm text-gray-500">{{ round($attachment->size / 1024, 1) }} KB</p>
                                                    </div>
                                                    <a href="{{ $attachment->url }}" download="{{ $attachment->name }}"
                                                        class="ml-3 text-blue-600 hover:text-blue-800">
                                                        <i class="fas fa-download"></i>
                                                    </a>
                                                </div>
                                        @endif
                                @endforeach
                                </div>
                            </div>
                    @endif

                    <!-- Comments Section -->
                    <div class="bg-white shadow-lg rounded-lg p-6">
                        <h2  class="text-lg font-semibold text-gray-800 mb-4">Comments</h2>
                        <!-- Add comment form would go here -->
                        <div class="text-center py-8 text-gray-500">
                            <i class="fas fa-comments text-3xl mb-3"></i>
                            <p>Comments feature coming soon</p>
                        </div>
                    </div>
                </div>
            <!-- Sidebar -->
                <div class="space-y-6">
                    <!-- Actions -->
                    <div class="bg-white shadow-lg rounded-lg p-6">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">Actions</h3>
                        <div class="space-y-3">
                            <a href="{{ route('tickets.edit', $ticket) }}"
                                class="w-full flex items-center justify-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                                <i class="fas fa-edit mr-2"></i>
                                Edit Ticket
                            </a>
                            <form action="{{ route('tickets.destroy', $ticket) }}" method="POST" class="w-full">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="w-full flex items-center justify-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-red-600 hover:bg-red-700"
                                    onclick="return confirm('Are you sure you want to delete this ticket?')">
                                    <i class="fas fa-trash mr-2"></i>
                                    Delete Ticket
                                </button>
                            </form>
                        </div>
                    </div>

                    <!-- Ticket Info -->
                    <div class="bg-white shadow-lg rounded-lg p-6">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">Ticket Information</h3>
                        <dl class="space-y-3">
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Submitter</dt>
                                <dd class="text-sm text-gray-900">{{ $ticket->customer->full_name}}</dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Email</dt>
                                <dd class="text-sm text-gray-900">{{ $ticket->customer->email }}</dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Category</dt>
                                <dd class="text-sm text-gray-900">{{ $ticket->category->name }}</dd>
                            </div>
                        </dl>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection