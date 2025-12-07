<div class="bg-stone-50 font-sans text-gray-700 min-h-screen">

    <div class="bg-white border-b border-gray-200 py-6">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <h1 class="text-3xl font-serif font-bold text-gray-900">Checkout</h1>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <form wire:submit.prevent="placeOrder" class="lg:grid lg:grid-cols-2 lg:gap-x-12 xl:gap-x-16">

            <div>
                <h2 class="text-lg font-bold text-gray-900 mb-6">Shipping Details</h2>

                <div class="grid grid-cols-1 gap-y-6 sm:grid-cols-2 sm:gap-x-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">First Name</label>
                        <input wire:model="first_name" type="text"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-amber-800 focus:border-amber-800 sm:text-sm p-3 border">
                        @error('first_name')
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Last Name</label>
                        <input wire:model="last_name" type="text"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-amber-800 focus:border-amber-800 sm:text-sm p-3 border">
                    </div>

                    <div class="sm:col-span-2">
                        <label class="block text-sm font-medium text-gray-700">Phone / WhatsApp (Wajib)</label>
                        <input wire:model="phone" type="text" placeholder="08..."
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-amber-800 focus:border-amber-800 sm:text-sm p-3 border">
                        @error('phone')
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="sm:col-span-2">
                        <label class="block text-sm font-medium text-gray-700">Full Address</label>
                        <textarea wire:model="address" rows="3"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-amber-800 focus:border-amber-800 sm:text-sm p-3 border"></textarea>
                        @error('address')
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="sm:col-span-2">
                        <label class="block text-sm font-medium text-gray-700">City / Region (Untuk Cek Ongkir)</label>
                        <select wire:model.live="city"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-amber-800 focus:border-amber-800 sm:text-sm p-3 border bg-white">
                            <option value="">-- Pilih Wilayah --</option>
                            <optgroup label="Area Pulau Lombok (Free Ongkir)">
                                <option value="Kota Mataram">Kota Mataram</option>
                                <option value="Lombok Barat">Lombok Barat</option>
                                <option value="Lombok Tengah">Lombok Tengah</option>
                                <option value="Lombok Timur">Lombok Timur</option>
                                <option value="Lombok Utara">Lombok Utara</option>
                            </optgroup>
                            <optgroup label="Luar Pulau / Ekspor">
                                <option value="Sumbawa & Bima">Sumbawa & Bima</option>
                                <option value="Bali">Bali</option>
                                <option value="Jawa">Pulau Jawa</option>
                                <option value="Luar Pulau Lainnya">Luar Pulau Lainnya</option>
                                <option value="International">International (Export)</option>
                            </optgroup>
                        </select>
                        <p class="text-xs text-gray-500 mt-1">*Pilih wilayah yang sesuai untuk kalkulasi pengiriman.</p>
                    </div>

                    <div class="sm:col-span-2">
                        <label class="block text-sm font-medium text-gray-700">Notes (Optional)</label>
                        <textarea wire:model="notes"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-amber-800 focus:border-amber-800 sm:text-sm p-3 border"></textarea>
                    </div>
                </div>
            </div>

            <div class="mt-10 lg:mt-0">
                <div class="bg-white border border-gray-200 rounded-xl shadow-sm p-6 sticky top-6">
                    <h2 class="text-lg font-bold text-gray-900 mb-6">Order Summary</h2>

                    <div class="flow-root mb-6">
                        <ul class="divide-y divide-gray-200">
                            <li class="flex py-4">
                                <div class="h-16 w-16 flex-shrink-0 overflow-hidden rounded-md border border-gray-200">
                                    <img src="https://via.placeholder.com/150"
                                        class="h-full w-full object-cover object-center">
                                </div>
                                <div class="ml-4 flex flex-1 flex-col">
                                    <div>
                                        <div class="flex justify-between text-base font-medium text-gray-900">
                                            <h3><a href="#">Teak Lounge Chair</a></h3>
                                            <p class="ml-4">Rp 2.500.000</p>
                                        </div>
                                    </div>
                                    <div class="flex flex-1 items-end justify-between text-sm">
                                        <p class="text-gray-500">Qty 1</p>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>

                    <div class="border-t border-gray-200 pt-4 space-y-4">
                        <div class="flex items-center justify-between text-sm text-gray-600">
                            <p>Subtotal</p>
                            <p>Rp {{ number_format($subtotal, 0, ',', '.') }}</p>
                        </div>

                        <div class="flex items-center justify-between text-sm">
                            <p class="text-gray-600">Shipping</p>
                            <div class="text-right">
                                @if ($city)
                                    @if ($isLombokArea)
                                        <span class="text-green-600 font-bold">Gratis (Free)</span>
                                        <p class="text-xs text-gray-400">Kurir Toko / Pickup</p>
                                    @else
                                        <span class="text-amber-600 font-bold">Menunggu Konfirmasi</span>
                                        <p class="text-xs text-gray-400">Akan diinfokan ketika sudah pesan</p>
                                    @endif
                                @else
                                    <span class="text-gray-400">-</span>
                                @endif
                            </div>
                        </div>

                        <div class="flex items-center justify-between border-t border-gray-200 pt-4">
                            <p class="text-base font-bold text-gray-900">Grand Total</p>
                            <div class="text-right">
                                <p class="text-xl font-bold text-amber-800">Rp
                                    {{ number_format($grandTotal, 0, ',', '.') }}</p>
                                @if (!$isLombokArea && $city)
                                    <p class="text-[10px] text-gray-500 mt-1">*Belum termasuk ongkir luar pulau</p>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="mt-6">
                        <button type="submit"
                            class="w-full bg-amber-800 border border-transparent rounded-lg shadow-sm py-3 px-4 text-base font-medium text-white hover:bg-amber-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-amber-500 transition">
                            Confirm Order
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
