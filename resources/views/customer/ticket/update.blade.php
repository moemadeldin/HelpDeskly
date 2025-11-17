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

                <form action="{{ route('tickets.update', $ticket) }}" method="POST" enctype="multipart/form-data"
                    class="space-y-6">
                    @csrf
                    @method('PUT')

                    <!-- Subject -->
                    <div>
                        <label for="subject" class="block text-sm font-medium text-gray-700 mb-2">Subject *</label>
                        <input type="text" name="subject" id="subject" value="{{ old('subject', $ticket->subject) }}"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                            placeholder="Brief description of your issue" required>
                        @error('subject')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Category -->
                    <div>
                        <label for="category_id" class="block text-sm font-medium text-gray-700 mb-2">Category *</label>
                        <select name="category_id" id="category_id"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                            required>
                            <option value="">Select a category</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id', $ticket->category_id) == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Priority -->
                    <div>
                        <label for="priority" class="block text-sm font-medium text-gray-700 mb-2">Priority *</label>
                        <select name="priority" id="priority"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                            required>
                            <option value="">Select priority level</option>
                            @foreach(\App\Enums\TicketPriority::cases() as $priority)
                                <option value="{{ $priority->value }}" {{ old('priority', $ticket->priority->value) == $priority->value ? 'selected' : '' }}>
                                    {{ $priority->label() }}
                                </option>
                            @endforeach
                        </select>
                        @error('priority')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Description -->
                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Description *</label>
                        <textarea name="description" id="description" rows="6"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                            placeholder="Please provide detailed information about your issue..."
                            required>{{ old('description', $ticket->description) }}</textarea>
                        @error('description')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
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
                    <!-- New Attachments -->
                    <div>
                        <label for="attachments" class="block text-sm font-medium text-gray-700 mb-2">Add New
                            Attachments</label>
                        <input type="file" name="attachments[]" id="attachments" multiple
                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                            accept=".jpg,.jpeg,.png,.pdf,.doc,.docx">
                        <p class="mt-1 text-sm text-gray-500">You can attach multiple files (images, PDFs, documents)</p>

                        <!-- Add this for the main attachments error -->
                        @error('attachments')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror

                        @error('attachments.*')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Submit Buttons -->
                    <div class="flex justify-end space-x-4 pt-6">
                        <a href="{{ route('tickets.show', $ticket) }}"
                            class="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Cancel
                        </a>
                        <button type="submit"
                            class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Update Ticket
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection