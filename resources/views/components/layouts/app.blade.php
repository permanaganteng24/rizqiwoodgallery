<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $title ?? 'Rizqi Wood Gallery' }}</title>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="bg-stone-50 font-sans antialiased text-gray-900 flex flex-col min-h-screen">

    @livewire('navbar')

    <main class="flex-grow">
        {{ $slot }}
    </main>

    <!-- Footer -->
    <footer class="bg-white border-t border-gray-200 mt-auto">
        <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
            
            <!-- Main Footer Content -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 lg:gap-12">
                
                <!-- Brand Section -->
                <div class="lg:col-span-1">
                    <div class="flex items-center gap-2 mb-4">
                        <img src="{{ asset('assets/image/logo-big.png') }}" alt="Rizqi Wood Gallery" class="h-16 w-auto">
                    </div>
                    <p class="text-gray-600 text-sm leading-relaxed">
                        Curating timeless wood artistry from NTB for the world's finest interiors.
                    </p>
                </div>

                <!-- Collections -->
                <div>
                    <h4 class="text-sm font-bold mb-4 text-gray-900">Collections</h4>
                    <ul class="space-y-2 text-sm">
                        <li>
                            <a href="/products?category=living-room" class="text-gray-600 hover:text-amber-800 transition">
                                Living Room
                            </a>
                        </li>
                        <li>
                            <a href="/products?category=bedroom" class="text-gray-600 hover:text-amber-800 transition">
                                Bedroom
                            </a>
                        </li>
                        <li>
                            <a href="/products?category=kitchen-dining" class="text-gray-600 hover:text-amber-800 transition">
                                Kitchen & Dining
                            </a>
                        </li>
                        <li>
                            <a href="/products?category=decoration" class="text-gray-600 hover:text-amber-800 transition">
                                Decoration
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- Support -->
                <div>
                    <h4 class="text-sm font-bold mb-4 text-gray-900">Support</h4>
                    <ul class="space-y-2 text-sm">
                        <li>
                            <a href="/how-to-order" class="text-gray-600 hover:text-amber-800 transition">
                                How to Order
                            </a>
                        </li>
                        <li>
                            <a href="/shipping-info" class="text-gray-600 hover:text-amber-800 transition">
                                Shipping & Cargo Info
                            </a>
                        </li>
                        <li>
                            <a href="/contact" class="text-gray-600 hover:text-amber-800 transition">
                                Custom & Export Inquiry
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- Connect With Us -->
                <div>
                    <h4 class="text-sm font-bold mb-4 text-gray-900">Connect With Us</h4>
                    <ul class="space-y-3 text-sm text-gray-600">
                        <li>
                            <a href="tel:+6281945591108" class="hover:text-amber-800 transition">
                                (+62) 819-4559-1108
                            </a>
                        </li>
                        <li>
                            <a href="https://instagram.com/rizqiwoodgallery" target="_blank" class="hover:text-amber-800 transition">
                                @rizqiwoodgallery
                            </a>
                        </li>
                        <li class="text-gray-600 text-xs leading-relaxed pt-2">
                            Jl. Raya Meninting, Meninting,<br>
                            Kec. Batu Layar, Kabupaten Lombok Barat,<br>
                            Nusa Tenggara Barat 83511, Indonesia
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Bottom Footer -->
            <div class="border-t border-gray-200 mt-10 pt-8 text-center">
                <p class="text-sm text-gray-500">
                    © {{ date('Y') }} Rizky Wood Gallery. All rights reserved.
                </p>
            </div>
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