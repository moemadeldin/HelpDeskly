@props(['id', 'type' => 'text', 'label', 'icon', 'error' => null])

<div class="mb-4">
    <label for="{{ $id }}" class="block text-sm font-medium text-gray-700 mb-2">
        <i class="{{ $icon }} text-gray-400 mr-2"></i>{{ $label }}
    </label>
    <input 
        id="{{ $id }}" 
        type="{{ $type }}" 
        {{ $attributes->merge(['class' => 'w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200' . ($error ? ' border-red-500' : '')]) }}
    >
    @if($error)
        <p class="text-red-500 text-sm mt-1">{{ $error }}</p>
    @endif
</div>
