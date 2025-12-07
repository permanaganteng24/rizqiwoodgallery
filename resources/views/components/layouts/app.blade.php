<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $title ?? 'Rizqi Wood Gallery' }}</title>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="bg-gray-50 font-sans antialiased text-gray-900 flex flex-col min-h-screen">

    @livewire('navbar')

    <main class="flex-grow">
        {{ $slot }}
    </main>

    <footer class="bg-gray-900 text-white mt-auto">
        <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8 grid grid-cols-1 md:grid-cols-3 gap-8">
            <div>
                <h3 class="text-xl font-bold mb-4 font-serif">Rizqi Wood Gallery</h3>
                <p class="text-gray-400 text-sm leading-relaxed">
                    Menyediakan furniture kayu jati berkualitas tinggi dari pengrajin lokal NTB dengan desain modern dan klasik untuk hunian impian Anda.
                </p>
            </div>
            <div>
                <h3 class="text-lg font-semibold mb-4">Navigasi</h3>
                <ul class="space-y-2 text-sm text-gray-400">
                    <li><a href="/" class="hover:text-amber-500 transition">Home</a></li>
                    <li><a href="/products" class="hover:text-amber-500 transition">Katalog Produk</a></li>
                    <li><a href="/about" class="hover:text-amber-500 transition">Tentang Kami</a></li>
                </ul>
            </div>
            <div>
                <h3 class="text-lg font-semibold mb-4">Kontak</h3>
                <ul class="space-y-2 text-sm text-gray-400">
                    <li class="flex items-start gap-2">
                        <span>📍</span> Mataram, Nusa Tenggara Barat
                    </li>
                    <li class="flex items-start gap-2">
                        <span>📞</span> WhatsApp: 0812-3456-7890
                    </li>
                    <li class="flex items-start gap-2">
                        <span>✉️</span> Email: info@rizqiwood.com
                    </li>
                </ul>
            </div>
        </div>
        <div class="bg-gray-950 py-6 text-center text-xs text-gray-500 border-t border-gray-800">
            &copy; {{ date('Y') }} Rizqi Wood Gallery. All rights reserved.
        </div>
    </footer>

    @livewireScripts
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        Livewire.on('alert', (data) => {
            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: data.type,   
                title: data.message,
                showConfirmButton: false,
                timer: 3000,      
                timerProgressBar: true,
                customClass: {
                    popup: 'colored-toast'
                }
            });
        });
    </script>
</body>
</html>