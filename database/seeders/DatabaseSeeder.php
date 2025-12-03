<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Review;
use App\Models\LocalShippingRate;
use App\Models\UserAddress;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // ADMIN & CUSTOMER
        $admin = User::create([
            'name' => 'Admin Rizqi Wood',
            'email' => 'admin@rizqiwood.com',
            'password' => Hash::make('password'),
            'phone' => '081234567890',
            'role' => 'admin',
        ]);

        $customer = User::create([
            'name' => 'Budi Santoso',
            'email' => 'budi@gmail.com',
            'password' => Hash::make('password'),
            'phone' => '089876543210',
            'role' => 'customer',
        ]);

        // Alamat Customer
        UserAddress::create([
            'user_id' => $customer->id,
            'label' => 'Rumah Mataram',
            'recipient_name' => 'Budi Santoso',
            'phone' => '089876543210',
            'country' => 'Indonesia',
            'province' => 'Nusa Tenggara Barat',
            'city' => 'Mataram',
            'district' => 'Mataram',
            'postal_code' => '83126',
            'address_line' => 'Jl. Majapahit No. 12, Mataram',
            'is_default' => true,
        ]);

        $shippingRates = [
            ['city' => 'Mataram', 'district' => 'Mataram', 'rate' => 5000],
            ['city' => 'Mataram', 'district' => 'Ampenan', 'rate' => 5000],
            ['city' => 'Mataram', 'district' => 'Cakranegara', 'rate' => 5000],
            ['city' => 'Lombok Barat', 'district' => 'Batu Layar', 'rate' => 10000],
            ['city' => 'Lombok Barat', 'district' => 'Gunung Sari', 'rate' => 10000],
            ['city' => 'Lombok Tengah', 'district' => 'Praya', 'rate' => 15000],
        ];

        foreach ($shippingRates as $rate) {
            LocalShippingRate::create([
                'province' => 'Nusa Tenggara Barat',
                'city' => $rate['city'],
                'district' => $rate['district'],
                'rate_per_kg' => $rate['rate'],
            ]);
        }

        // KATEGORI
        $categories = [
            ['name' => 'Living Room', 'slug' => 'living-room'],
            ['name' => 'Bedroom', 'slug' => 'bedroom'],
            ['name' => 'Kitchen & Dining', 'slug' => 'kitchen-dining'],
            ['name' => 'Decoration', 'slug' => 'decoration'],
        ];

        foreach ($categories as $cat) {
            Category::create($cat);
        }

        // BUAT PRODUK
        $products = [
            [
                'name' => 'Teak Lounge Chair',
                'slug' => 'teak-lounge-chair',
                'description' => 'Kursi santai minimalis berbahan jati solid.',
                'price' => 2500000,
                'weight_kg' => 8,
                'length_cm' => 60, 'width_cm' => 60, 'height_cm' => 80,
                'material' => 'Solid Teak',
                'finishing' => 'Natural Matte',
                'color' => 'Natural',
                'stock' => 10,
                'availability' => 'ready',
            ],
            [
                'name' => 'Asgard Sofa 3 Seater',
                'slug' => 'asgard-sofa-3-seater',
                'description' => 'Sofa nyaman dengan rangka kayu mahoni.',
                'price' => 6000000,
                'weight_kg' => 45,
                'length_cm' => 200, 'width_cm' => 85, 'height_cm' => 75,
                'material' => 'Mahogany & Fabric',
                'finishing' => 'Dark Walnut',
                'color' => 'Navy Blue',
                'stock' => 5,
                'availability' => 'pre_order',
            ],
            [
                'name' => 'Rustic Coffee Table',
                'slug' => 'rustic-coffee-table',
                'description' => 'Meja kopi dari akar jati asli.',
                'price' => 1500000,
                'weight_kg' => 15,
                'length_cm' => 100, 'width_cm' => 60, 'height_cm' => 45,
                'material' => 'Teak Root',
                'finishing' => 'Glossy',
                'color' => 'Natural Root',
                'stock' => 3,
                'availability' => 'ready',
            ],
        ];

        foreach ($products as $prodData) {
            $product = Product::create($prodData);
            $catIds = Category::inRandomOrder()->take(rand(1, 2))->pluck('id');
            $product->categories()->attach($catIds);

        }


        // Skenario A: Order Domestik (Mataram) - SUDAH BAYAR
        $order1 = Order::create([
            'user_id' => $customer->id,
            'code' => 'ORD-2025-001',
            'shipping_name' => 'Budi Santoso',
            'shipping_phone' => '089876543210',
            'shipping_address' => 'Jl. Majapahit No. 12',
            'shipping_city' => 'Mataram',
            'shipping_province' => 'NTB',
            'shipping_country' => 'Indonesia',
            'shipping_district' => 'Mataram',
            'shipping_method' => 'domestic',
            'total_weight_kg' => 8,
            'total_product_price' => 2500000,
            'shipping_price' => 40000,
            'grand_total' => 2540000,
            'order_status' => 'processing',
            'payment_status' => 'paid',
            'payment_url' => 'https://app.midtrans.com/snap/v1/transactions/example',
            'paid_at' => Carbon::now(),
        ]);

        OrderItem::create([
            'order_id' => $order1->id,
            'product_id' => 1, // Kursi
            'product_name' => 'Teak Lounge Chair',
            'quantity' => 1,
            'price_per_unit' => 2500000,
            'subtotal' => 2500000,
        ]);

        // Skenario B: Order Cargo (Luar Negeri) - MENUNGGU QUOTE ADMIN
        $order2 = Order::create([
            'user_id' => $customer->id,
            'code' => 'ORD-2025-002',
            'shipping_name' => 'John Doe',
            'shipping_phone' => '+1 555 0199',
            'shipping_address' => '123 Beverly Hills',
            'shipping_city' => 'Los Angeles',
            'shipping_province' => 'California',
            'shipping_country' => 'United States',
            'shipping_method' => 'cargo_export', 
            'total_weight_kg' => 45,
            'total_product_price' => 6000000,
            'shipping_price' => 0,
            'grand_total' => 6000000,
            'order_status' => 'waiting_quote', 
            'payment_status' => 'unpaid',
        ]);

        OrderItem::create([
            'order_id' => $order2->id,
            'product_id' => 2, // Sofa
            'product_name' => 'Asgard Sofa 3 Seater',
            'quantity' => 1,
            'price_per_unit' => 6000000,
            'subtotal' => 6000000,
        ]);

        // REVIEW
        Review::create([
            'user_id' => $customer->id,
            'product_id' => 1,
            'order_id' => $order1->id,
            'rating' => 5,
            'comment' => 'Barang sangat bagus, kayu jatinya halus. Pengiriman di Mataram cepat.',
            'is_approved' => true,
        ]);
    }
}