@if (session('success'))
    <div class="mb-4 rounded-md bg-green-100 p-4 text-sm text-green-800 ring-1 ring-inset ring-green-300">
        {{ session('success') }}
    </div>
@endif

@if (session('error'))
    <div class="mb-4 rounded-md bg-red-600/20 p-4 text-sm text-red-300 ring-1 ring-inset ring-red-500/30">
        {{ session('error') }}
    </div>
@endif