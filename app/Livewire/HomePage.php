<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Product;
use Livewire\Attributes\Title;
use Livewire\Component;

class HomePage extends Component
{
    #[Title('Home - Rizqi Wood Gallery')] 
    public function render()
    {
        $categories = Category::take(4)->get();

        $products = Product::where('is_active', true)
            ->with('galleries') 
            ->latest()
            ->take(8)
            ->get();

        return view('livewire.home-page', [
            'categories' => $categories,
            'products' => $products,
        ]);
    }
}