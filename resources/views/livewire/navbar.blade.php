<nav class="bg-white shadow-sm sticky top-0 z-50 border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">

            <a href="/" class="flex-shrink-0 flex items-center">
                <img src="{{ asset('assets/image/logo.svg') }}" alt="Rizqi Wood Logo" class="h-9 w-auto">
            </a>

            <div class="hidden md:flex space-x-8">
                <a href="/" class="text-gray-600 hover:text-amber-800 font-medium transition">Home</a>
                <a href="/products" class="text-gray-600 hover:text-amber-800 font-medium transition">Catalog</a>
            </div>

            <div class="flex items-center space-x-6">

                <a href="/cart" class="relative group text-gray-500 hover:text-amber-800 transition">
                    <x-heroicon-o-shopping-bag class="w-6 h-6" />

                    @if ($total_count > 0)
                        <span class="absolute -top-2 -right-2 bg-red-600 text-white text-[10px] font-bold rounded-full h-5 w-5 flex items-center justify-center shadow-sm">
                            {{ $total_count }}
                        </span>
                    @endif
                </a>

                @auth
                    <div class="relative group">
                        <button class="text-sm font-medium text-gray-600 hover:text-amber-800">
                            {{ auth()->user()->name }}
                        </button>
                        <div class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 hidden group-hover:block border border-gray-100">
                            <a href="/logout" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Logout</a>
                        </div>
                    </div>
                @else
                    <a href="/login" class="text-sm font-medium text-amber-800 hover:text-amber-900">Log in</a>
                @endauth

            </div>
        </div>
    </div>
</nav>