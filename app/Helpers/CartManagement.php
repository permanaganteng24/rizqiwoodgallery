<?php

namespace App\Helpers;

use App\Models\Product;
use Illuminate\Support\Facades\Cookie;

class CartManagement
{
    static public function addItemToCart($product_id)
    {
        $cart_items = self::getCartItemsFromCookie();
        $existing_item = null;

        foreach ($cart_items as $key => $item) {
            if ($item['product_id'] == $product_id) {
                $existing_item = $key;
                break;
            }
        }

        if ($existing_item !== null) {
            return count($cart_items);
        }

        $product = Product::with('galleries')->find($product_id);

        if ($product) {
            $item = [
                'product_id' => $product->id,
                'name' => $product->name,
                'slug' => $product->slug,
                'image' => $product->galleries->first()->image_url ?? '',
                'price' => $product->price,
                'quantity' => 1, 
                'total_amount' => $product->price
            ];
            $cart_items[] = $item;
        }

        self::addCartItemsToCookie($cart_items);
        return count($cart_items);
    }

    static public function addItemToCartWithQty($product_id, $qty = 1)
    {
        $cart_items = self::getCartItemsFromCookie();
        $existing_item = null;

        foreach ($cart_items as $key => $item) {
            if ($item['product_id'] == $product_id) {
                $existing_item = $key;
                break;
            }
        }

        $product = Product::with('galleries')->find($product_id);

        if ($existing_item !== null) {
            $cart_items[$existing_item]['quantity'] += $qty;
            $cart_items[$existing_item]['total_amount'] = $cart_items[$existing_item]['quantity'] * $cart_items[$existing_item]['price'];
        } else {
            if($product) {
                $item = [
                    'product_id' => $product->id,
                    'name' => $product->name,
                    'slug' => $product->slug,
                    'image' => $product->galleries->first()->image_url ?? '',
                    'price' => $product->price,
                    'quantity' => $qty,
                    'total_amount' => $product->price * $qty
                ];
                $cart_items[] = $item;
            }
        }

        self::addCartItemsToCookie($cart_items);
        
        return $cart_items; 
    }

    static public function removeCartItem($product_id)
    {
        $cart_items = self::getCartItemsFromCookie();

        foreach ($cart_items as $key => $item) {
            if ($item['product_id'] == $product_id) {
                unset($cart_items[$key]);
            }
        }

        $cart_items = array_values($cart_items);
        self::addCartItemsToCookie($cart_items);

        return $cart_items;
    }

    static public function getCartItemsFromCookie()
    {
        $cart_items = json_decode(Cookie::get('cart_items'), true);
        if (!$cart_items) {
            $cart_items = [];
        }
        return $cart_items;
    }

    static public function getCartItemsCount()
    {
        $cart_items = self::getCartItemsFromCookie();
        return count($cart_items);
    }

    static public function addCartItemsToCookie($cart_items)
    {
        Cookie::queue('cart_items', json_encode($cart_items), 60 * 24 * 30);
    }

    static public function clearCartItems()
    {
        Cookie::queue(Cookie::forget('cart_items'));
    }
}
