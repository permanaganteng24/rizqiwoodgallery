<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Attributes\Title;
use Livewire\Component;

class ProductDetail extends Component
{
    public $slug;
    public $quantity = 1;

    public function mount($slug)
    {
        $this->slug = $slug;
    }

    public function incrementQty()
    {
        $this->quantity++;
    }

    public function decrementQty()
    {
        if ($this->quantity > 1) {
            $this->quantity--;
        }
    }

    public function addToCart()
    {
        $this->dispatch('notify', 'Fitur Keranjang akan segera hadir!');
    }

    #[Title('Detail Produk')] 
    public function render()
    {
        $product = Product::where('slug', $this->slug)
            ->with(['galleries', 'categories', 'reviews.user'])
            ->where('is_active', true)
            ->firstOrFail();

        $relatedProducts = Product::whereHas('categories', function ($query) use ($product) {
                $query->whereIn('categories.id', $product->categories->pluck('id'));
            })
            ->where('id', '!=', $product->id) 
            ->where('is_active', true)
            ->take(4)
            ->get();

        return view('livewire.product-detail', [
            'product' => $product,
            'relatedProducts' => $relatedProducts
        ]);
    }
}