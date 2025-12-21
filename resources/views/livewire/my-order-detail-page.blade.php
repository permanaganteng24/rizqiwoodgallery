<div class="w-full max-w-[85rem] py-10 px-4 sm:px-6 lg:px-8 mx-auto bg-stone-50 min-h-screen">

    <!-- Breadcrumb & Title -->
    <div class="flex items-center gap-2 mb-6">
        <a href="/my-orders" class="text-gray-500 hover:text-amber-800 flex items-center gap-1 transition">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="w-4 h-4">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
            </svg>
            Back to Orders
        </a>
        <span class="text-gray-300">|</span>
        <h1 class="text-2xl font-bold text-gray-900">Order #{{ $order->code }}</h1>
    </div>

    <!-- Status Banner -->
    <div class="mb-6">
        @if($order->order_status == 'waiting_quote')
            <div class="bg-amber-50 border border-amber-200 rounded-xl p-4 flex gap-4 items-start shadow-sm">
                <div class="bg-amber-100 rounded-full p-2 text-amber-600 shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div>
                    <h3 class="font-bold text-amber-800">Awaiting Shipping Confirmation</h3>
                    <p class="text-sm text-amber-700 mt-1">
                        Your order is being reviewed by our admin team to determine cargo shipping costs
                        (International/Inter-island).
                        Please check this page periodically or wait for WhatsApp notification.
                    </p>
                </div>
            </div>

        @elseif($order->order_status == 'waiting_payment')
            <div class="bg-green-50 border border-green-200 rounded-xl p-4 flex gap-4 items-start shadow-sm">
                <div class="bg-green-100 rounded-full p-2 text-green-600 shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div class="flex-1">
                    <h3 class="font-bold text-green-800">Shipping Cost Confirmed!</h3>
                    <p class="text-sm text-green-700 mt-1">
                        Total amount is now finalized. Please proceed with payment to process your order.
                    </p>
                </div>

                <button
                    class="bg-green-700 text-white px-6 py-2 rounded-lg font-bold hover:bg-green-800 transition shadow-md whitespace-nowrap">
                    Pay Now
                </button>
            </div>
        @endif
    </div>

    <!-- Main Content Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        <!-- Products & Shipping Info -->
        <div class="lg:col-span-2 space-y-6">

            <!-- Product List -->
            <div class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden">
                <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
                    <h3 class="font-bold text-gray-800">Order Items</h3>
                </div>
                <ul class="divide-y divide-gray-200">
                    @foreach ($order->items as $item)
                        <li class="p-6 flex gap-4">
                            <div
                                class="h-20 w-20 flex-shrink-0 overflow-hidden rounded-md border border-gray-200 bg-gray-100">
                                @php $image = $item->product->galleries->first()->image_url ?? null; @endphp
                                <img src="{{ $image ? asset('storage/' . $image) : 'https://via.placeholder.com/100' }}"
                                    class="h-full w-full object-cover">
                            </div>
                            <div class="flex-1 min-w-0">
                                <h4 class="text-sm font-bold text-gray-900">{{ $item->product_name }}</h4>
                                <p class="text-sm text-gray-500 mt-1">
                                    Qty: {{ number_format($item->quantity) }} × Rp
                                    {{ number_format($item->price_per_unit, 0, ',', '.') }}
                                </p>
                            </div>
                            <div class="text-right">
                                <p class="text-sm font-bold text-gray-900">
                                    Rp {{ number_format($item->subtotal, 0, ',', '.') }}
                                </p>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>

            <!-- Shipping Information -->
            <div class="bg-white border border-gray-200 rounded-xl shadow-sm p-6">
                <h3 class="font-bold text-gray-800 mb-4 border-b border-gray-100 pb-3 flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-600" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    Shipping Information
                </h3>
                <div class="grid md:grid-cols-2 gap-6 text-sm">
                    <div>
                        <span class="block text-gray-500 text-xs uppercase font-semibold mb-2">Recipient</span>
                        <p class="font-medium text-gray-900">{{ $order->shipping_name }}</p>
                        <p class="text-gray-600 mt-1">{{ $order->shipping_phone }}</p>
                        <p class="text-gray-600">{{ $order->shipping_email }}</p>
                    </div>
                    <div>
                        <span class="block text-gray-500 text-xs uppercase font-semibold mb-2">Delivery Address</span>
                        <p class="text-gray-600 leading-relaxed">
                            {{ $order->shipping_address }}<br>
                            {{ $order->shipping_district }}, {{ $order->shipping_city }}<br>
                            {{ $order->shipping_province }} - {{ $order->shipping_postal_code }}<br>
                            {{ $order->shipping_country }}
                        </p>
                    </div>
                </div>
            </div>

        </div>

        <!-- Order Summary -->
        <div class="lg:col-span-1">
            <div class="bg-white border border-gray-200 rounded-xl shadow-sm p-6 lg:sticky lg:top-6">
                <h3 class="font-bold text-gray-800 mb-4 text-lg">Order Summary</h3>

                <div class="space-y-4 text-sm">

                    <!-- Order Status -->
                    <div class="flex justify-between items-center pb-4 border-b border-gray-100">
                        <span class="text-gray-500 font-medium">Order Status</span>
                        <span class="inline-flex items-center gap-1.5 py-1 px-3 rounded-full text-xs font-bold uppercase tracking-wide
                            {{ $order->order_status == 'waiting_quote' ? 'bg-gray-100 text-gray-600' : '' }}
                            {{ $order->order_status == 'waiting_payment' ? 'bg-amber-100 text-amber-700' : '' }}
                            {{ $order->order_status == 'new' ? 'bg-blue-100 text-blue-700' : '' }}
                        ">
                            {{ str_replace('_', ' ', ucfirst($order->order_status)) }}
                        </span>
                    </div>

                    <!-- Price Breakdown -->
                    <div class="space-y-3">
                        <div class="flex justify-between text-gray-600">
                            <span>Subtotal</span>
                            <span>Rp {{ number_format($order->total_product_price, 0, ',', '.') }}</span>
                        </div>

                        @if($order->discount_amount > 0)
                            <div class="flex justify-between text-green-600">
                                <span>Discount</span>
                                <span>- Rp {{ number_format($order->discount_amount, 0, ',', '.') }}</span>
                            </div>
                        @endif

                        <div class="flex justify-between text-gray-600">
                            <span>Shipping</span>

                            @if($order->shipping_price == 0 && $order->order_status == 'waiting_quote')
                                <span class="text-xs bg-gray-200 px-2 py-1 rounded text-gray-600 font-medium">Pending</span>

                            @elseif($order->shipping_price == 0)
                                <span class="font-bold">Free</span>

                            @else
                                <span>Rp {{ number_format($order->shipping_price, 0, ',', '.') }}</span>
                            @endif
                        </div>
                    </div>

                    <!-- Grand Total -->
                    <div class="border-t border-gray-200 pt-4">
                        <div class="flex justify-between text-lg font-bold text-gray-900">
                            <span>Total</span>
                            <span>Rp {{ number_format($order->grand_total, 0, ',', '.') }}</span>
                        </div>
                        <p class="text-xs text-gray-400 text-right mt-1">Tax included</p>
                    </div>

                    <!-- Download Invoice Button -->
                    <div class="flex gap-4 mt-4 justify-end">

                        @if($order->payment_status == 'unpaid')
                            {{-- Tombol Bayar --}}
                        @endif

                        <a href="{{ route('invoice.download', $order->id) }}" target="_blank"
                            class="bg-[#6B4226] hover:bg-[#5D3A20] text-white px-6 py-2 rounded-lg flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-printer" viewBox="0 0 16 16">
                                <path d="M2.5 8a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1z" />
                                <path
                                    d="M5 1a2 2 0 0 0-2 2v2H2a2 2 0 0 0-2 2v3a2 2 0 0 0 2 2h1v1a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2v-1h1a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-1V3a2 2 0 0 0-2-2H5zM4 3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v2H4V3zm1 5a2 2 0 0 0-2 2v1H2a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-1v-1a2 2 0 0 0-2-2H5zm7 2v3a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1z" />
                            </svg>
                            Download Invoice
                        </a>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>