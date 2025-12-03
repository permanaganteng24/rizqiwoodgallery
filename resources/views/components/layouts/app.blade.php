<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $title ?? 'Rizqi Wood Gallery' }}</title>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="bg-gray-50 font-sans antialiased text-gray-900">

    <!-- NAVBAR -->
    <nav class="bg-white shadow-sm sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <!-- Logo -->
                <div class="flex items-center">
                    <a href="/" class="text-2xl font-bold text-amber-700 flex items-center gap-2">
                        <x-heroicon-o-home class="w-8 h-8" /> 
                        Rizqi Wood
                    </a>
                </div>

                <!-- Desktop Menu -->
                <div class="hidden sm:flex sm:items-center sm:space-x-8">
                    <a href="/" class="text-gray-600 hover:text-amber-700 font-medium {{ request()->is('/') ? 'text-amber-700' : '' }}">
                        Home
                    </a>
                    <a href="/products" class="text-gray-600 hover:text-amber-700 font-medium">
                        Katalog
                    </a>
                    
                    <!-- Cart Icon -->
                    <a href="/cart" class="relative text-gray-600 hover:text-amber-700">
                        <x-heroicon-o-shopping-bag class="w-6 h-6" />
                        {{-- <span class="absolute -top-2 -right-2 bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center">0</span> --}}
                    </a>

                    @auth
                        <a href="/admin" class="text-sm bg-amber-100 text-amber-800 px-3 py-1 rounded-full font-medium">
                            My Account
                        </a>
                    @else
                        <a href="/admin/login" class="text-sm font-medium text-gray-600 hover:text-gray-900">
                            Log in
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- MAIN CONTENT -->
    <main class="min-h-screen">
        {{ $slot }}
    </main>

    <!-- FOOTER -->
    <footer class="bg-gray-900 text-white mt-12">
        <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8 grid grid-cols-1 md:grid-cols-3 gap-8">
            <div>
                <h3 class="text-xl font-bold mb-4">Rizqi Wood Gallery</h3>
                <p class="text-gray-400 text-sm">
                    Menyediakan furniture kayu jati berkualitas tinggi dengan desain modern dan klasik untuk hunian impian Anda.
                </p>
            </div>
            <div>
                <h3 class="text-lg font-semibold mb-4">Navigasi</h3>
                <ul class="space-y-2 text-sm text-gray-400">
                    <li><a href="/" class="hover:text-white">Home</a></li>
                    <li><a href="/products" class="hover:text-white">Katalog Produk</a></li>
                    <li><a href="/about" class="hover:text-white">Tentang Kami</a></li>
                </ul>
            </div>
            <div>
                <h3 class="text-lg font-semibold mb-4">Kontak</h3>
                <ul class="space-y-2 text-sm text-gray-400">
                    <li>Mataram, Nusa Tenggara Barat</li>
                    <li>WhatsApp: 0812-3456-7890</li>
                    <li>Email: info@rizqiwood.com</li>
                </ul>
            </div>
        </div>
        <div class="bg-gray-800 py-4 text-center text-xs text-gray-500">
            &copy; {{ date('Y') }} Rizqi Wood Gallery. All rights reserved.
        </div>
    </footer>

    @livewireScripts
</body>
</html>