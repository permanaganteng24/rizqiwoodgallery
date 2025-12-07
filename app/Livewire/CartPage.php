<?php

namespace App\Livewire;

use App\Helpers\CartManagement;
use Livewire\Attributes\Title;
use Livewire\Component;

class CartPage extends Component
{
    #[Title('Keranjang Belanja - Rizqi Wood')]

    public $cart_items = [];
    public $grand_total = 0;

    public function mount()
    {
        $this->cart_items = CartManagement::getCartItemsFromCookie();
        $this->calculateTotal();
    }

    public function incrementQty($product_id)
    {
        $this->cart_items = CartManagement::addItemToCartWithQty($product_id, 1);
        
        $this->calculateTotal();
    }

    public function decrementQty($product_id)
    {
        $cart_data = CartManagement::getCartItemsFromCookie();
        
        foreach ($cart_data as $item) {
            if ($item['product_id'] == $product_id) {
                if ($item['quantity'] > 1) {
                    $this->cart_items = CartManagement::addItemToCartWithQty($product_id, -1);
                }
                break;
            }
        }
        
        $this->calculateTotal();
    }

    public function removeItem($product_id)
    {
        $this->cart_items = CartManagement::removeCartItem($product_id);
        
        $this->calculateTotal();
        $this->dispatch('cart-updated', total_count: count($this->cart_items));
        $this->dispatch('alert', type: 'success', message: 'Item dihapus.');
    }

    public function calculateTotal()
    {
        $this->grand_total = 0;
        foreach ($this->cart_items as $item) {
            $this->grand_total += $item['total_amount'];
        }
    }

    public function render()
    {
        return view('livewire.cart-page');
    }
}