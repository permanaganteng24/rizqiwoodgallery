<?php

namespace App\Livewire;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product; // Pastikan model Product di-import
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Title;
use Livewire\Component;

class CheckoutPage extends Component
{
    #[Title('Checkout - Rizqi Wood Gallery')]

    // Form Properties
    public $first_name;
    public $last_name;
    public $phone;
    public $email;
    public $address;
    public $city;
    public $province;
    public $postal_code;
    public $notes;

    // Cart & Summary
    public $cartItems = [];
    public $subtotal = 0;
    public $shippingCost = 0;
    public $grandTotal = 0;
    
    // Logic Ongkir
    public $isLombokArea = false;
    public $shippingLabel = 'Pilih Kota Terlebih Dahulu';

    public $lombokCities = [
        'Kota Mataram',
        'Lombok Barat',
        'Lombok Tengah',
        'Lombok Timur',
        'Lombok Utara'
    ];

    public function mount()
    {
        if (Auth::check()) {
            $user = Auth::user();
            $this->first_name = $user->name;
            $this->email = $user->email;
        }

        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $this->cartItems = \App\Helpers\CartManagement::getCartItemsFromCookie();
        if (count($this->cartItems) == 0) {
            return redirect()->route('products.index');
        }

        $this->calculateTotals();
    }

    public function updatedCity()
    {
        if (in_array($this->city, $this->lombokCities)) {
            $this->isLombokArea = true;
            $this->shippingCost = 0;
            $this->shippingLabel = 'Free Shipping (Area Lombok)';
        } else {
            $this->isLombokArea = false;
            $this->shippingCost = 0; 
            $this->shippingLabel = 'Menunggu Konfirmasi Admin (Dikalkulasi Manual)';
        }

        $this->calculateTotals();
    }

    public function calculateTotals()
    {
        if($this->subtotal == 0) $this->subtotal = 2500000; 

        $this->grandTotal = $this->subtotal + $this->shippingCost;
    }

    public function placeOrder()
    {
        $this->validate([
            'first_name' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'city' => 'required',
        ]);

        DB::beginTransaction();
        try {
            $order = Order::create([
                'user_id' => Auth::id(), 
                'code' => 'ORD-' . strtoupper(uniqid()),
                'shipping_name' => $this->first_name . ' ' . $this->last_name,
                'shipping_phone' => $this->phone,
                'shipping_address' => $this->address,
                'shipping_city' => $this->city,
                'shipping_province' => $this->province ?? 'NTB',
                'shipping_method' => $this->isLombokArea ? 'Free Shipping (Lombok)' : 'Kargo (Menunggu Konfirmasi)',
                'shipping_price' => 0, 
                'total_product_price' => $this->subtotal,
                'grand_total' => $this->grandTotal,
                'order_status' => 'pending',
                'payment_status' => 'unpaid',
                'notes' => $this->notes,
            ]);


            DB::commit();

            session()->flash('success', 'Order berhasil dibuat! Admin akan menghubungi untuk konfirmasi pengiriman.');
            
        } catch (\Exception $e) {
            DB::rollBack();
            session()->flash('error', 'Gagal memproses order: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.checkout-page');
    }

    
}