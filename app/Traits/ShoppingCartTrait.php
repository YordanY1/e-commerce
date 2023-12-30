//write shopping cart trait that calculates the total price of the cart based on session storage cart
<?php

namespace App\Traits;

use App\Models\Product;
use App\Models\ProductAttribute;
use App\Models\Price;
use Illuminate\Http\Request;

trait ShoppingCartTrait
{
    public function addToCart(Product $product, Request $request)
    {
        $cart = $request->session()->get('cart');
        if (empty($cart)) {
            $cart = [];
        }
        if (array_key_exists($product->id, $cart)) {
            $cart[$product->id]['quantity']++;
        } else {
            $cart[$product->id] = [
                'quantity' => 1,
                'product_id' => $product->id,
                'product_name' => $product->name,
                'product_price' => $product->price,
                'product_image' => $product->image,
            ];
        }
        $request->session()->put('cart', $cart);
        return true;
    }

    public function removeFromCart(Product $product, Request $request)
    {
        $cart = $request->session()->get('cart');
        if (empty($cart)) {
            $cart = [];
        }
        if (array_key_exists($product->id, $cart)) {
            unset($cart[$product->id]);
        }
        $request->session()->put('cart', $cart);
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
        $total = 0;
        $data = [];
        if (empty($cart)) {
            $cart = [];
        }
        foreach ($cart as $item) {
            $total += $item['product_price'] * $item['quantity'];
            $data[] = [
                'product_id' => $item['product_id'],
                'product_name' => $item['product_name'],
                'product_price' => $item['product_price'],
                'product_image' => $item['product_image'],
                'quantity' => $item['quantity'],
            ];
        }
        $data['total'] = $total;
        return $data;
    }

    public function getCartCount(Request $request)
    {
        $cart = $request->session()->get('cart');
        if (empty($cart)) {
            $cart = [];
        }
        return count($cart);
    }

    public function getCartTotal(Request $request)
    {
        $cart = $request->session()->get('cart');
        $total = 0;
        if (empty($cart)) {
            $cart = [];
        }
        foreach ($cart as $item) {
            $total += $item['product_price'] * $item['quantity'];
        }
        return $total;
    }
}