<div class="w-full max-w-[85rem] py-10 px-4 sm:px-6 lg:px-8 mx-auto bg-stone-50 min-h-screen">
    <div class="max-w-7xl mx-auto">
        <h1 class="text-3xl font-serif font-bold text-gray-900 mb-8">Shopping Cart</h1>

        <div class="flex flex-col lg:flex-row gap-8">
            <div class="flex-1 space-y-4">
                @forelse ($cart_items as $item)
                    <div class="bg-white border border-gray-200 rounded-xl p-4 flex gap-4 items-center shadow-sm">
                        <div class="w-24 h-24 bg-gray-100 rounded-lg overflow-hidden flex-shrink-0">
                            <img src="{{ asset('storage/' . $item['image']) }}" class="w-full h-full object-cover">
                        </div>

                        <div class="flex-1">
                            <h3 class="text-lg font-bold text-gray-800">{{ $item['name'] }}</h3>
                            <p class="text-amber-700 font-medium">Rp {{ number_format($item['price'], 0, ',', '.') }}
                            </p>
                        </div>

                        <div class="flex items-center border border-gray-300 rounded-lg">
                            <button wire:click="decrementQty({{ $item['product_id'] }})"
                                class="px-3 py-1 text-gray-600 hover:bg-gray-100">-</button>
                            <span class="px-3 py-1 text-gray-900 font-medium">{{ $item['quantity'] }}</span>
                            <button wire:click="incrementQty({{ $item['product_id'] }})"
                                class="px-3 py-1 text-gray-600 hover:bg-gray-100">+</button>
                        </div>

                        <div class="text-right ml-4">
                            <p class="font-bold text-gray-900 mb-2">Rp
                                {{ number_format($item['total_amount'], 0, ',', '.') }}</p>
                            <button wire:click="removeItem({{ $item['product_id'] }})"
                                class="text-red-500 hover:text-red-700 text-sm underline">
                                Remove
                            </button>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-20 bg-white rounded-xl border border-dashed border-gray-300">
                        <x-heroicon-o-shopping-cart class="w-12 h-12 text-gray-300 mx-auto mb-4" />
                        <p class="text-gray-500">Your cart is empty.</p>
                        <a href="/products" class="text-amber-800 font-bold hover:underline mt-2 inline-block">Start
                            Shopping</a>
                    </div>
                @endforelse
            </div>

            <div class="w-full lg:w-96">
                <div class="bg-white border border-gray-200 rounded-xl p-6 shadow-sm sticky top-24">
                    <h2 class="text-xl font-bold text-gray-900 mb-4">Summary</h2>
                    <div class="flex justify-between items-center mb-4 pb-4 border-b border-gray-100">
                        <span class="text-gray-600">Subtotal</span>
                        <span class="font-bold text-gray-900">Rp {{ number_format($grand_total, 0, ',', '.') }}</span>
                    </div>

                    @if (count($cart_items) > 0)
                        <a href="/checkout"
                            class="w-full block text-center bg-amber-800 text-white font-bold py-3 rounded-lg hover:bg-amber-900 transition shadow-lg">
                            Proceed to Checkout
                        </a>
                    @else
                        <button disabled
                            class="w-full bg-gray-300 text-gray-500 font-bold py-3 rounded-lg cursor-not-allowed">
                            Checkout
                        </button>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
