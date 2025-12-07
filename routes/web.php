<?php

use App\Livewire\Auth\LoginPage;
use App\Livewire\Auth\RegisterPage;
use App\Livewire\CartPage;
use App\Livewire\CatalogPage;
use App\Livewire\CheckoutPage;
use App\Livewire\HomePage;
use App\Livewire\ProductDetail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', HomePage::class)->name('home');
Route::get('/products/{slug}', ProductDetail::class)->name('product.detail');
Route::get('/products', CatalogPage::class)->name('products.index');
Route::get('/products/{slug}', ProductDetail::class)->name('products.show');

// Route Auth
Route::get('/login', LoginPage::class)->name('login');
Route::get('/register', RegisterPage::class)->name('register');

Route::get('/cart', CartPage::class)->name('cart');

// Route Belanja
Route::get('/checkout', CheckoutPage::class)->name('checkout'); 
// Tambahkan route logout (Logout sederhana via closure)
Route::get('/logout', function () {
    Auth::logout();
    return redirect('/');
});