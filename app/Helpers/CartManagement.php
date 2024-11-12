<?php

namespace App\Helpers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\Cookie;
use Mockery\Generator\Method;

class CartManagement
{
    static public function addItemToCart($product_id){
        $cart_Items = self::getCartItemsFromCookie();
        $existing_item = null;
        foreach ($cart_Items as $key => $item) {
            if ($item['product_id'] == $product_id) {
                $existing_item = $key;
                break;
            }
        }

        if ($existing_item !== null) {
            $cart_Items[$existing_item]['quantity']++;
            $cart_Items[$existing_item]['total_amount'] = $cart_Items[$existing_item]['quantity']*$cart_Items[$existing_item]['unit_amount'];
        } else {
            $product = Product::where('id', $product_id)->first(['id', 'name', 'images', 'price']);
            if ($product) {
                $cart_Items[] = [
                    'product_id' => $product_id,
                    'name' => $product->name,
                    'images' => $product->images[0],
                    'quantity' => 1,
                    'unit_amount' => $product->price,
                    'total_amount' => $product->price,
                ];
            }
        }
        self::addCartItemsToCookie($cart_Items);
        return count($cart_Items);
    }

    static public function addItemToCartWithQty($product_id, $qty = 1){
        $cart_Items = self::getCartItemsFromCookie();
        $existing_item = null;
        foreach ($cart_Items as $key => $item) {
            if ($item['product_id'] == $product_id) {
                $existing_item = $key;
                break;
            }
        }

        if ($existing_item !== null) {
            $cart_Items[$existing_item]['quantity'] = $qty;
            $cart_Items[$existing_item]['total_amount'] = $cart_Items[$existing_item]['quantity']*$cart_Items[$existing_item]['unit_amount'];
        } else {
            $product = Product::where('id', $product_id)->first(['id', 'name', 'images', 'price']);
            if ($product) {
                $cart_Items[] = [
                    'product_id' => $product_id,
                    'name' => $product->name,
                    'images' => $product->images[0],
                    'quantity' => $qty,
                    'unit_amount' => $product->price,
                    'total_amount' => $product->price,
                ];
            }
        }
        self::addCartItemsToCookie($cart_Items);
        return count($cart_Items);
    }

    static public function removeCartItem($product_id){
        $cart_Items = self::getCartItemsFromCookie();
        foreach ($cart_Items as $key => $item) {
            if ($item['product_id'] == $product_id) {
                unset($cart_Items[$key]);
                break;
            }
        }
        self::addCartItemsToCookie($cart_Items);
        return $cart_Items;
    }

    static public function addCartItemsToCookie($cart_Items){
        Cookie::queue('cart_items', json_encode($cart_Items), 60 * 24 * 30);
    }

    static public function clearCartItems(){
        Cookie::queue(Cookie::forget('cart_items'));
    }
    static public function getCartItemsFromCookie(){
        $cart_items = json_decode(Cookie::get('cart_items'), true);
        if (!$cart_items) {
            $cart_items = [];
        }
        return $cart_items;
    }


    static public function incrementQuantityToCartItem($product_id){
        $cart_Items = self::getCartItemsFromCookie();
        foreach ($cart_Items as $key => $item) {
            if ($item['product_id'] == $product_id) {
                $cart_Items[$key]['quantity']++;
                $cart_Items[$key]['total_amount'] = $cart_Items[$key]['quantity']*$cart_Items[$key]['unit_amount'];

            }
        }
        self::addCartItemsToCookie($cart_Items);
        return $cart_Items;
    }

    static public function decrementQuantityToCartItem($product_id){
        $cart_Items = self::getCartItemsFromCookie();
        foreach ($cart_Items as $key => $item) {
            if ($item['product_id'] == $product_id) {
                if ($cart_Items[$key]['quantity'] > 1) {
                    $cart_Items[$key]['quantity']--;
                    $cart_Items[$key]['total_amount'] = $cart_Items[$key]['quantity']*$cart_Items[$key]['unit_amount'];
                }
            }
        }
        self::addCartItemsToCookie($cart_Items);
        return $cart_Items;
    }

    static public function calculateGrandTotal($items){
        return array_sum(array_column($items, 'total_amount'));
    }
}
