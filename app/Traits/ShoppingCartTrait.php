<?php

namespace App\Traits;

use App\Models\Product;
use App\Models\ProductAttribute;
use App\Models\Price;
use Illuminate\Http\Request;

trait ShoppingCartTrait
{
    public function addToCart($product_data, Request $request)
    {
        //TODO Product object find by id
        //Array
        $cart = $request->session()->get('cart');

        if (empty($cart)) {
            $cart = [
                'products' => [],
                'total' => 0.00,
            ];
        }

        if (array_key_exists($product_data['id'], $cart['products'])) {
            $cart['products'][$product_data['id']]['quantity']++;
        } else {
            $cart['products'][$product_data['id']] = [
                'id' => $product_data['id'],
                'quantity' => 1,
                'name' => $product_data['name'],
                'price' => $product_data['price'],
                'price_currency' => $product_data['price_currency'], // 'BGN
                'image' => $product_data['image'],
            ];
        }

        $request->session()->put('cart', $cart);

        return true;
    }

    public function removeFromCart($product_data, Request $request)
    {
        $cart_products = $request->session()->get('cart.products');

        if (empty($cart_products)) {
            $cart_products = [];
        }

        if (array_key_exists($product_data['id'], $cart_products)) {
            unset($cart_products[$product_data['id']]);
        }

        $request->session()->put('cart.products', $cart_products);

        return true;
    }

    public function emptyCart(Request $request)
    {
        $request->session()->forget('cart');

        return true;
    }

    public function getCart(Request $request)
    {
        $cart = $request->session()->get('cart');

        $total = 0.00;

        $data = [
            'products' => [],
            'total' => $total,
        ];

        if (empty($cart)) {
            $cart = $data;
        }

        foreach ($cart as $key => $item) {
            $total += $item['price'] * $item['quantity'];
            $data['products'][$key] = [
                'id' => $item['id'],
                'quantity' => $item['quantity'],
                'name' => $item['name'],
                'price' => $item['price'],
                'price_currency' => $item['price_currency'],
                'image' => $item['image'],
            ];
        }

        $data['total'] = $total;

        return $data;
    }

    public function getCartCount(Request $request)
    {
        $cart_products = $request->session()->get('cart.products');

        if (empty($cart_products)) {
            $cart_products = [];
        }

        return count($cart_products);
    }

    public function getCartTotal(Request $request)
    {
        $cart_products = $request->session()->get('cart.products');

        $total = 0;
        
        if (empty($cart_products)) {
            $cart_products = [];
        }
        
        foreach ($cart_products as $key => $item) {
            $total += $item['price'] * $item['quantity'];
        }

        return $total;
    }
}