<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Product;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Database\Eloquent\Builder;

class CatalogPage extends Component
{
    use WithPagination;

    #[Title('Katalog Produk - Rizqi Wood Gallery')]

    #[Url]
    public $search = '';

    #[Url]
    public $selectedCategories = [];

    #[Url]
    public $priceMin = null;

    #[Url]
    public $priceMax = null;

    #[Url]
    public $sort = 'latest';
    
    #[Url]
    public $readyStock = false;

    public function updatedSearch() { $this->resetPage(); }
    public function updatedSelectedCategories() { $this->resetPage(); }
    public function updatedPriceMin() { $this->resetPage(); }
    public function updatedPriceMax() { $this->resetPage(); }
    public function updatedSort() { $this->resetPage(); }
    public function updatedReadyStock() { $this->resetPage(); }

    public function render()
    {
        $query = Product::query()->where('is_active', true); 

        if ($this->search) {
            $query->where('name', 'like', '%' . $this->search . '%');
        }

        if (!empty($this->selectedCategories)) {
            $query->whereHas('categories', function ($q) {
                $q->whereIn('id', $this->selectedCategories);
            });
        }

        if ($this->priceMin) {
            $query->where('price', '>=', $this->priceMin);
        }
        if ($this->priceMax) {
            $query->where('price', '<=', $this->priceMax);
        }

        if ($this->readyStock) {
            $query->where('availability', 'ready');
        }

        if ($this->sort === 'price_asc') {
            $query->orderBy('price', 'asc');
        } elseif ($this->sort === 'price_desc') {
            $query->orderBy('price', 'desc');
        } else {
            $query->latest();
        }

        return view('livewire.catalog-page', [
            'products' => $query->paginate(9),
            'categories' => Category::orderBy('name')->get(), 
        ]);
    }

    public function resetFilters()
    {
        $this->reset(['search', 'selectedCategories', 'priceMin', 'priceMax', 'readyStock', 'sort']);
        $this->resetPage();
    }
}