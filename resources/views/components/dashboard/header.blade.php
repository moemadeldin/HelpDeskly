<header class="bg-white shadow-sm">
    <div class="flex items-center justify-between p-4">
        <div class="flex items-center">
            <img src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}&background=0D8ABC&color=fff" alt="User"
                class="w-10 h-10 rounded-full">
            <div class="ml-3">
                <p class="font-medium">{{ Auth::user()->name }}</p>
            </div>
        </div>
        <div class="flex items-center space-x-4">
            @auth
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button
                        class="px-4 py-2 bg-slate-700 hover:bg-slate-600 rounded-md text-white font-medium transition cursor-pointer">
                        Logout
                    </button>
                </form>
            @endauth
            <a href="{{ route('home') }}"
                class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 rounded-md text-white font-medium transition">
                Home
            </a>
        </div>
        <div class="flex items-center space-x-4">
            <button class="bg-gray-100 p-2 rounded-full hover:bg-gray-200">
                <i class="fas fa-bell text-gray-600"></i>
            </button>
            <button class="bg-gray-100 p-2 rounded-full hover:bg-gray-200">
                <i class="fas fa-cog text-gray-600"></i>
            </button>
        </div>
    </div>
</header>