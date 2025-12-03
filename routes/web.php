<?php

use App\Livewire\CatalogPage;
use App\Livewire\HomePage;
use App\Livewire\ProductDetail;
use Illuminate\Support\Facades\Route;

Route::get('/', HomePage::class)->name('home');
Route::get('/products/{slug}', ProductDetail::class)->name('product.detail');
Route::get('/products', CatalogPage::class)->name('products.index');