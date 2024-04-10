<?php

namespace App\Traits;

use App\Models\Product;
use App\Models\ProductAttribute;
use App\Models\Price;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

trait ShoppingCartTrait
{
    public function addToCart($product_data, Request $request) {
        $cart = $request->session()->get('cart', ['products' => [], 'total' => 0.00]);
        $productId = $product_data['id'];

        if(isset($cart['products'][$productId])) {
            // Product exists, update quantity and recalculate price
            $cart['products'][$productId]['quantity'] += $product_data['quantity'];
        } else {
            // New product, add to cart
            $cart['products'][$productId] = $product_data;
        }

        // Recalculate total
        $cart['total'] = array_reduce($cart['products'], function($carry, $item) {
            return $carry + ($item['price'] * $item['quantity']);
        }, 0);

        $request->session()->put('cart', $cart);
        Log::info('Cart updated:', $cart);

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
