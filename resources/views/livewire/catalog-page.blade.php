<div class="bg-white font-sans text-gray-700" x-data="{ mobileFiltersOpen: false }">

    <div class="bg-stone-50 border-b border-stone-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 text-center">
            <h1 class="text-4xl font-serif font-bold text-gray-900 mb-2">Our Catalog</h1>
            <nav class="flex justify-center text-sm text-gray-500 gap-2 items-center">
                <a href="/" class="hover:text-amber-800 transition">Home</a>
                <x-heroicon-m-chevron-right class="w-3 h-3 text-gray-400" />
                <span class="text-gray-900 font-medium">Catalog</span>
            </nav>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="flex flex-col lg:flex-row gap-12">

            <div class="lg:hidden mb-4">
                <button @click="mobileFiltersOpen = !mobileFiltersOpen"
                    class="w-full flex items-center justify-center gap-2 bg-stone-100 py-3 rounded-lg text-gray-900 font-medium hover:bg-stone-200 transition">
                    <x-heroicon-o-funnel class="w-5 h-5" />
                    Filters & Sort
                </button>
            </div>

            <div :class="{ 'hidden': !mobileFiltersOpen, 'block': mobileFiltersOpen }"
                class="hidden lg:block w-full lg:w-64 flex-shrink-0 space-y-8">

                <div>
                    <h3 class="font-serif font-bold text-gray-900 mb-4 text-lg">Search</h3>
                    <div class="relative">
                        <input wire:model.live.debounce.300ms="search" type="text" placeholder="Search furniture..."
                            class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-amber-800 focus:border-amber-800 text-sm">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <x-heroicon-o-magnifying-glass class="h-4 w-4 text-gray-400" />
                        </div>
                    </div>
                </div>

                <div>
                    <h3 class="font-serif font-bold text-gray-900 mb-4 text-lg border-b border-gray-200 pb-2">Categories
                    </h3>
                    <div class="space-y-3">
                        @foreach ($categories as $category)
                            <label class="flex items-center gap-3 cursor-pointer group">
                                <input type="checkbox" wire:model.live="selectedCategories" value="{{ $category->id }}"
                                    class="rounded border-gray-300 text-amber-800 focus:ring-amber-800 w-4 h-4">
                                <span
                                    class="text-sm text-gray-600 group-hover:text-amber-800 transition">{{ $category->name }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>

                <div>
                    <h3 class="font-serif font-bold text-gray-900 mb-4 text-lg border-b border-gray-200 pb-2">Price
                        Range</h3>
                    <div class="grid grid-cols-2 gap-2 mb-4">
                        <div>
                            <label class="text-xs text-gray-500">Min</label>
                            <input wire:model.live.debounce.500ms="priceMin" type="number" placeholder="0"
                                class="w-full border-gray-300 rounded text-sm py-1 px-2 focus:ring-amber-800 focus:border-amber-800">
                        </div>
                        <div>
                            <label class="text-xs text-gray-500">Max</label>
                            <input wire:model.live.debounce.500ms="priceMax" type="number" placeholder="Max"
                                class="w-full border-gray-300 rounded text-sm py-1 px-2 focus:ring-amber-800 focus:border-amber-800">
                        </div>
                    </div>
                </div>

                <div>
                    <h3 class="font-serif font-bold text-gray-900 mb-4 text-lg border-b border-gray-200 pb-2">
                        Availability</h3>
                    <label class="flex items-center gap-3 cursor-pointer mt-2">
                        <input wire:model.live="readyStock" type="checkbox"
                            class="rounded border-gray-300 text-amber-800 focus:ring-amber-800 w-4 h-4">
                        <span class="text-sm text-gray-600">Ready Stock Only</span>
                    </label>
                </div>

                <button wire:click="resetFilters"
                    class="text-sm text-gray-500 underline hover:text-amber-800 w-full text-left">
                    Clear All Filters
                </button>
            </div>

            <div class="flex-1">

                <div class="flex flex-col sm:flex-row justify-between items-center mb-8 pb-4 border-b border-stone-200">
                    <p class="text-gray-500 text-sm mb-4 sm:mb-0">
                        Showing <span class="font-bold text-gray-900">{{ $products->total() }}</span> results
                    </p>

                    <div class="flex items-center gap-3">
                        <span class="text-sm text-gray-500">Sort by:</span>
                        <select wire:model.live="sort"
                            class="border-gray-300 text-sm rounded-lg focus:ring-amber-800 focus:border-amber-800 py-2 pl-3 pr-8 cursor-pointer">
                            <option value="latest">Newest Arrivals</option>
                            <option value="price_asc">Price: Low to High</option>
                            <option value="price_desc">Price: High to Low</option>
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                    @forelse ($products as $product)
                        <div
                            class="group bg-white rounded-2xl p-3 hover:shadow-xl transition duration-300 border border-transparent hover:border-gray-100 flex flex-col h-full relative">
                            <div class="relative bg-stone-100 rounded-xl overflow-hidden aspect-[4/5] mb-4">
                                @php $img = $product->galleries->first(); @endphp
                                @if ($img)
                                    <img src="{{ asset('storage/' . $img->image_url) }}" alt="{{ $product->name }}"
                                        class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                                @else
                                    <div
                                        class="w-full h-full flex items-center justify-center bg-gray-200 text-gray-400">
                                        <span class="text-sm">No Image</span>
                                    </div>
                                @endif

                                @if ($product->availability === 'pre_order')
                                    <span
                                        class="absolute top-3 left-3 bg-blue-600 text-white text-[10px] font-bold px-2 py-1 rounded uppercase tracking-wider shadow-sm">
                                        Pre-Order
                                    </span>
                                @elseif($product->availability === 'out_of_stock' || $product->stock <= 0)
                                    <span
                                        class="absolute top-3 left-3 bg-gray-600 text-white text-[10px] font-bold px-2 py-1 rounded uppercase tracking-wider shadow-sm">
                                        Sold Out
                                    </span>
                                @endif

                                <div
                                    class="absolute bottom-4 left-0 right-0 flex justify-center opacity-0 group-hover:opacity-100 transition duration-300 transform translate-y-4 group-hover:translate-y-0">
                                    <a href="/products/{{ $product->slug }}"
                                        class="bg-white text-gray-900 hover:text-amber-700 shadow-lg rounded-full p-3 mx-1 transition">
                                        <x-heroicon-o-eye class="w-5 h-5" />
                                    </a>
                                </div>
                            </div>

                            <div class="px-2 pb-2 flex-grow flex flex-col">
                                <p class="text-xs text-gray-500 mb-1">
                                    {{ $product->categories->first()->name ?? 'Furniture' }}</p>
                                <h3
                                    class="text-lg font-bold text-gray-900 group-hover:text-amber-800 transition mb-1 leading-tight">
                                    <a href="/products/{{ $product->slug }}">
                                        {{ $product->name }}
                                    </a>
                                </h3>

                                <div class="mt-auto pt-2 flex items-center justify-between">
                                    <span class="font-bold text-gray-900">Rp
                                        {{ number_format($product->price, 0, ',', '.') }}</span>
                                    <div class="flex text-yellow-400 text-xs items-center gap-1">
                                        <x-heroicon-s-star class="w-4 h-4" />
                                        <span class="text-gray-500 font-medium">4.8</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-full py-16 text-center">
                            <div
                                class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-stone-100 mb-4">
                                <x-heroicon-o-archive-box-x-mark class="w-8 h-8 text-gray-400" />
                            </div>
                            <h3 class="text-lg font-medium text-gray-900">No products found</h3>
                            <p class="text-gray-500 mt-1">Try adjusting your filters or search query.</p>
                            <button wire:click="resetFilters" class="mt-4 text-amber-800 font-medium hover:underline">
                                Clear all filters
                            </button>
                        </div>
                    @endforelse
                </div>

                <div class="mt-12">
                    {{ $products->links() }}
                </div>

            </div>
        </div>
    </div>
</div>
