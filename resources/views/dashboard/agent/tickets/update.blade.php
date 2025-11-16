@extends('layouts.app')

@section('title', 'Edit Ticket #' . $ticket->id . ' - HelpDeskly')

@section('content')
    <div class="py-8 px-4 sm:px-6 lg:px-8">
        <div class="max-w-2xl mx-auto">
            <div class="bg-white shadow-lg rounded-lg p-6">
                <div class="flex items-center justify-between mb-6">
                    <h1 class="text-2xl font-bold text-gray-800">Edit Ticket</h1>
                    <span class="px-3 py-1 rounded-full text-sm font-semibold bg-gray-100 text-gray-800">
                        #{{ $ticket->id }}
                    </span>
                </div>

                <form action="{{ route('dashboard.agent.tickets.update', $ticket) }}" method="POST"
                    enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <!-- Subject (Read-Only) -->
                    <div>
                        <label for="subject" class="block text-sm font-medium text-gray-700 mb-2">Subject *</label>
                        <input type="text" id="subject" value="{{ $ticket->subject }}"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-100 text-gray-500 cursor-not-allowed"
                            disabled>
                        <input type="hidden" name="subject" value="{{ $ticket->subject }}">
                    </div>

                    <!-- Category (Read-Only) -->
                    <div>
                        <label for="category_id" class="block text-sm font-medium text-gray-700 mb-2">Category *</label>
                        <select id="category_id"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-100 text-gray-500 cursor-not-allowed"
                            disabled>
                            <option value="">Select a category</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ $ticket->category_id == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        <input type="hidden" name="category_id" value="{{ $ticket->category_id }}">
                    </div>

                    <!-- Priority (Read-Only) -->
                    <div>
                        <label for="priority" class="block text-sm font-medium text-gray-700 mb-2">Priority *</label>
                        <select id="priority"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-100 text-gray-500 cursor-not-allowed"
                            disabled>
                            <option value="">Select priority level</option>
                            @foreach(\App\Enums\TicketPriority::cases() as $priority)
                                <option value="{{ $priority->value }}" {{ $ticket->priority->value == $priority->value ? 'selected' : '' }}>
                                    {{ ucfirst($priority->value) }}
                                </option>
                            @endforeach
                        </select>
                        <input type="hidden" name="priority" value="{{ $ticket->priority->value }}">
                    </div>
                    <div>
                        <label for="status" class="block text-sm font-medium text-gray-700 mb-2">Status *</label>
                        <select name="status" id="status"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                            required>
                            <option value="">Select current status</option>
                            @foreach(\App\Enums\TicketStatus::cases() as $status)
                                <option value="{{ $status->value }}" {{ old('status', $ticket->status->value) == $status->value ? 'selected' : '' }}>
                                    {{ ucfirst($status->value) }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Description (Read-Only) -->
                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Description *</label>
                        <textarea id="description" rows="6"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-100 text-gray-500 cursor-not-allowed"
                            disabled>{{ $ticket->description }}</textarea>
                        <input type="hidden" name="description" value="{{ $ticket->description }}">
                    </div>

                    <!-- Current Attachments -->
                    @if($ticket->attachments->count() > 0)
                        <div class="mt-4">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Current Attachments</label>
                            <div class="space-y-2">
                                @foreach($ticket->attachments as $attachment)
                                    <div class="flex items-center justify-between p-2 border rounded">
                                        <span class="text-sm">{{ $attachment->name }}</span>
                                        <a href="{{ $attachment->url }}" download class="text-blue-600">Download</a>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <!-- Upload Disabled -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Add New Attachments</label>
                        <input type="file"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-100 text-gray-500 cursor-not-allowed"
                            disabled>
                        <p class="mt-1 text-sm text-gray-500">Attachment upload disabled.</p>
                    </div>

                    <!-- Submit Buttons -->
                    <div class="flex justify-end space-x-4 pt-6">
                        <a href="{{ route('dashboard.agent.tickets.show', $ticket) }}"
                            class="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50">
                            Cancel
                        </a>
                        <button type="submit"
                            class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700">
                            Update Ticket
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection