<div>
    <div class="relative w-full h-[600px] flex items-center justify-center bg-stone-100 overflow-visible mb-24">
        <div class="absolute inset-0 z-0">
            <img src="https://images.unsplash.com/photo-1616486338812-3dadae4b4ace?q=80&w=2000&auto=format&fit=crop"
                alt="Background Living Room" class="w-full h-full object-cover opacity-90">
            <div class="absolute inset-0 bg-black/10"></div>
        </div>

        {{-- Hero Section --}}
        <div class="relative z-10 text-center px-4 max-w-5xl mx-auto">
            <p class="text-sm md:text-base tracking-[0.2em] text-white font-semibold uppercase mb-4 drop-shadow-md">
                Artistry from NTB, Indonesia
            </p>
            <h1 class="text-4xl md:text-6xl lg:text-7xl font-bold text-white mb-2 drop-shadow-lg">
                A GALLERY OF
            </h1>
            <h1 class="text-4xl md:text-6xl lg:text-7xl font-bold text-white mb-8 drop-shadow-lg">
                NATURAL ELEGANCE
            </h1>

            <div class="flex flex-col sm:flex-row gap-4 justify-center items-center mt-8">
                <a href="/products"
                    class="px-8 py-3 bg-amber-700 hover:bg-amber-800 text-white font-medium rounded shadow-lg transition duration-300">
                    Shop Now
                </a>
                <a href="#story"
                    class="px-8 py-3 border-2 border-white text-white font-medium rounded hover:bg-white hover:text-gray-900 transition duration-300 shadow-sm">
                    Explore Our Craft
                </a>
            </div>
        </div>

        {{-- Search Bar Section --}}
        <div class="absolute -bottom-8 left-0 right-0 z-30 px-4">
            <div class="max-w-3xl mx-auto bg-white rounded-lg shadow-2xl p-2 flex items-center border border-gray-100">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-400 ml-3" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
                <input wire:model.live.debounce.300ms="search" type="text" placeholder="Search Product..."
                    class="flex-grow px-4 py-3 outline-none text-gray-600 placeholder-gray-400 bg-transparent">
                <button
                    class="bg-amber-800 hover:bg-amber-900 text-white px-8 py-3 rounded transition font-medium hidden sm:block">
                    Search
                </button>
            </div>
        </div>
    </div>

    {{-- About Section --}}
    <section id="story" class="py-12 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
            <div>
                <span class="text-amber-700 font-bold tracking-wide uppercase text-sm">The Art Woodcraft</span>
                <h2 class="text-4xl font-serif font-bold text-gray-900 mt-2 mb-6">Why Choose US?</h2>
                <p class="text-gray-500 mb-8 leading-relaxed">
                    We don't just sell furniture, we create heirlooms. Each piece from our gallery is a story of premium
                    materials and passionate local artisans from NTB.
                </p>
                {{-- List Text --}}
                <div class="space-y-6">
                    <div class="border-b border-gray-200 pb-4">
                        <h3 class="font-bold text-gray-900 text-lg">Bespoke & Custom Furniture</h3>
                        <p class="text-gray-600 text-sm mt-1">Tailored to your exact vision and space.</p>
                    </div>
                    <div class="border-b border-gray-200 pb-4">
                        <h3 class="font-bold text-gray-900 text-lg">Premium & Sustainable Materials</h3>
                        <p class="text-gray-600 text-sm mt-1">Only the finest, locally-sourced NTB woods.</p>
                    </div>
                </div>
            </div>
            <div class="relative h-[400px] md:h-[500px] mt-8 lg:mt-0">
                <img src="https://images.unsplash.com/photo-1598300042247-d088f8ab3a91?q=80&w=800&auto=format&fit=crop"
                    class="absolute top-0 right-0 w-3/4 h-3/5 object-cover rounded-tr-[50px] rounded-bl-[50px] shadow-lg z-10 border-4 border-white">
                <img src="https://images.unsplash.com/photo-1604014237800-1c9102c219da?q=80&w=800&auto=format&fit=crop"
                    class="absolute bottom-0 left-0 w-3/4 h-3/5 object-cover rounded-tl-[50px] rounded-br-[50px] shadow-lg z-0">
            </div>
        </div>
    </section>

    <section class="py-12 bg-white mb-12 border-y border-gray-50">
        <div
            class="max-w-5xl mx-auto px-4 grid grid-cols-1 md:grid-cols-3 gap-8 text-center divide-y md:divide-y-0 md:divide-x divide-gray-100">
            <div class="py-4 md:py-0">
                <h3 class="text-5xl font-bold text-gray-900">10+</h3>
                <p class="text-gray-500 mt-2 text-sm uppercase tracking-wide">Years of<br>Craftsmanship</p>
            </div>
            <div class="py-4 md:py-0">
                <h3 class="text-5xl font-bold text-gray-900">700+</h3>
                <p class="text-gray-500 mt-2 text-sm uppercase tracking-wide">Projects & Pieces<br>Delivered</p>
            </div>
            <div class="py-4 md:py-0">
                <h3 class="text-5xl font-bold text-gray-900">10+</h3>
                <p class="text-gray-500 mt-2 text-sm uppercase tracking-wide">Countries Served<br>Worldwide</p>
            </div>
        </div>
    </section>


    <section class="py-16 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Signature Products Section --}}
        <div class="text-center mb-12">
            <h2 class="text-3xl font-serif font-bold text-gray-900">Our Signature Collections</h2>
            <p class="text-gray-500 mt-3 max-w-2xl mx-auto">Discover curated pieces that bring warmth.</p>
        </div>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
            @foreach ($categories as $category)
                <a href="/products?category={{ $category->slug }}" class="group cursor-pointer block">
                    <div class="relative overflow-hidden rounded-3xl aspect-[4/5] mb-4 shadow-sm bg-stone-200">
                        @if ($category->icon)
                            <img src="{{ asset('storage/' . $category->icon) }}" alt="{{ $category->name }}"
                                class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                        @else
                            <div class="w-full h-full flex items-center justify-center text-gray-400"><span
                                    class="text-4xl opacity-20">?</span></div>
                        @endif
                        <div
                            class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-80">
                        </div>
                        <div class="absolute bottom-6 left-0 right-0 text-center">
                            <h3 class="text-white font-medium text-lg group-hover:text-amber-200 transition">
                                {{ $category->name }}</h3>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </section>

    {{-- Newest Products Section --}}
    <section class="py-16 bg-stone-50 overflow-hidden my-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col lg:flex-row gap-12 items-center">

                <div class="lg:w-1/3 text-center lg:text-left">
                    <h2 class="text-4xl font-serif font-bold text-gray-900 mb-4">Our Newest<br>Collection</h2>
                    <p class="text-gray-500 mb-8">Our designer already made a lot of beautiful prototype of rooms that
                        inspire you.</p>
                    <a href="/products?sort=newest"
                        class="inline-block px-8 py-3 bg-amber-800 text-white font-medium rounded hover:bg-amber-900 transition shadow-md">
                        Explore Now
                    </a>
                </div>

                <div class="lg:w-2/3 w-full relative" x-data="{
                    scrollLeft() {
                            $refs.scroller.scrollBy({ left: -300, behavior: 'smooth' });
                        },
                        scrollRight() {
                            $refs.scroller.scrollBy({ left: 300, behavior: 'smooth' });
                        }
                }">

                    <button @click="scrollLeft()"
                        class="absolute left-0 top-1/2 -translate-y-1/2 z-10 -ml-4 w-10 h-10 bg-white rounded-full shadow-lg flex items-center justify-center text-gray-600 hover:text-amber-800 hover:scale-110 transition border border-gray-100 hidden md:flex">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                            stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
                        </svg>
                    </button>

                    <div x-ref="scroller" class="flex gap-6 overflow-x-auto pb-8 snap-x scrollbar-hide scroll-smooth"
                        style="-ms-overflow-style: none; scrollbar-width: none;">
                        @foreach ($products as $product)
                            <a href="/products/{{ $product->slug }}"
                                class="min-w-[260px] md:min-w-[280px] snap-center group cursor-pointer block">
                                <div
                                    class="bg-white rounded-xl p-4 shadow-sm group-hover:shadow-md transition duration-300 h-full border border-transparent group-hover:border-stone-200">

                                    <div class="relative bg-stone-100 rounded-lg overflow-hidden aspect-[4/5] mb-4">
                                        @php $image = $product->galleries->first(); @endphp

                                        @if ($image)
                                            <img src="{{ asset('storage/' . $image->image_url) }}"
                                                alt="{{ $product->name }}"
                                                class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                                        @else
                                            <div
                                                class="w-full h-full flex flex-col items-center justify-center text-gray-400 bg-gray-200">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                    class="w-10 h-10 mb-2 opacity-50">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                                                </svg>
                                                <span class="text-sm font-medium">No Image</span>
                                            </div>
                                        @endif
                                    </div>

                                    <div class="space-y-1">
                                        <p class="text-xs text-gray-500">
                                            {{ $product->categories->first()->name ?? 'Furniture' }}</p>
                                        <h3
                                            class="font-bold text-gray-900 text-lg truncate group-hover:text-amber-700 transition">
                                            {{ $product->name }}</h3>
                                        <div class="flex items-center justify-between">
                                            <span class="font-bold text-amber-700">Rp
                                                {{ number_format($product->price, 0, ',', '.') }}</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>

                    <button @click="scrollRight()"
                        class="absolute right-0 top-1/2 -translate-y-1/2 z-10 -mr-4 w-10 h-10 bg-white rounded-full shadow-lg flex items-center justify-center text-gray-600 hover:text-amber-800 hover:scale-110 transition border border-gray-100 hidden md:flex">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                            stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                        </svg>
                    </button>

                </div>
            </div>
        </div>
    </section>

    {{-- Best Products Section --}}
    <section class="py-20 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-10">
            <h2 class="text-3xl font-serif font-bold text-gray-900">Our Best Quality Products</h2>
            <p class="text-gray-500 mt-3">Explore our exclusive collection.</p>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-8">
            @foreach ($products as $product)
                <div
                    class="group bg-white rounded-2xl p-3 hover:shadow-xl transition duration-300 border border-transparent hover:border-gray-100">
                    <div class="relative bg-stone-100 rounded-xl overflow-hidden aspect-square mb-4">
                        @php $image = $product->galleries->first(); @endphp
                        @if ($image)
                            <img src="{{ asset('storage/' . $image->image_url) }}" alt="{{ $product->name }}"
                                class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                        @else
                            <div class="w-full h-full bg-gray-200 flex items-center justify-center text-gray-400">No
                                Img</div>
                        @endif
                    </div>
                    <div class="px-2 pb-2">
                        <div class="flex text-yellow-500 text-xs mb-1">★★★★☆ <span
                                class="text-gray-400 ml-1">(5)</span></div>
                        <h3 class="text-lg font-bold text-gray-900 group-hover:text-amber-700 cursor-pointer truncate">
                            <a href="/products/{{ $product->slug }}">{{ $product->name }}</a>
                        </h3>
                        <div class="flex items-center gap-3 mt-1">
                            <span class="font-bold text-gray-900">Rp
                                {{ number_format($product->price, 0, ',', '.') }}</span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
</div>
