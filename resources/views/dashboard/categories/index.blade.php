@extends('dashboard.layout')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
        <div class="bg-white shadow rounded-lg p-6">
            <h1 class="text-2xl font-bold mb-4 text-gray-800">Categories</h1>
            <div class="flex justify-end mb-4">
                <a href="{{ route('categories.create') }}"
                    class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded hover:bg-blue-700 transition">
                    <i class="fas fa-plus mr-2"></i>
                    Create Category
                </a>
            </div>
            <x-flash-message/>
            {{-- Users Table --}}
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Name</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Slug</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse ($categories as $category)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">{{ $category->name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">{{ $category->slug }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm space-x-2">
                                    <a href="{{ route('categories.show', $category) }}"
                                        class="inline-flex items-center px-3 py-1 text-xs font-medium bg-blue-500 text-white rounded hover:bg-blue-600">
                                        Show
                                    </a>
                                    <a href="{{ route('categories.edit', $category) }}"
                                        class="inline-flex items-center px-3 py-1 text-xs font-medium bg-yellow-500 text-white rounded hover:bg-yellow-600">
                                        Update
                                    </a>
                                    <form action="{{ route('categories.destroy', $category) }}" method="POST"
                                        class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="inline-flex items-center px-3 py-1 text-xs font-medium bg-red-500 text-white rounded hover:bg-red-600"
                                            onclick="return confirm('Are you sure?')">
                                            Destroy
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-4 text-gray-500">No Categories found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            {{-- Pagination --}}
            <div class="mt-4">
                {{-- {{ $categories->links() }} --}}
            </div>
        </div>
    </div>
@endsection