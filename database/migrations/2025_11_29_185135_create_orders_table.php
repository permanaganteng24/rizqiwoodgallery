<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('code')->unique(); // No Resi Toko
            
            // Info Pengiriman
            $table->string('shipping_name');
            $table->string('shipping_phone');
            $table->text('shipping_address');
            $table->string('shipping_country')->default('Indonesia');
            $table->string('shipping_province')->nullable();
            $table->string('shipping_city')->nullable();
            $table->string('shipping_district')->nullable();
            $table->string('shipping_postal_code')->nullable();
            
            // Hybrid Logic
            $table->enum('shipping_method', ['domestic', 'cargo_export']);
            $table->string('shipping_courier')->nullable();
            $table->string('tracking_number')->nullable();
            
            // Biaya
            $table->decimal('total_weight_kg', 8, 2);
            $table->decimal('total_product_price', 15, 2);
            $table->decimal('shipping_price', 15, 2)->default(0);
            $table->decimal('discount_amount', 15, 2)->default(0);
            $table->decimal('grand_total', 15, 2);
            
            // Status Order (Diubah dari 'status' ke 'order_status' agar sesuai Seeder)
            $table->enum('order_status', [
                'waiting_quote',    // Cargo: Menunggu Admin
                'waiting_payment',  // Siap Bayar
                'processing',       // Sudah Bayar / Diproses
                'shipped',          // Dikirim
                'completed',        // Selesai
                'cancelled'         // Batal
            ])->default('waiting_payment');

            // Pembayaran
            // Menambahkan payment_status agar sesuai Seeder
            $table->enum('payment_status', ['unpaid', 'paid', 'expired', 'failed'])->default('unpaid');
            
            $table->enum('payment_method', ['midtrans', 'manual_transfer'])->default('midtrans');
            $table->string('payment_url')->nullable();
            $table->timestamp('paid_at')->nullable();
            
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};