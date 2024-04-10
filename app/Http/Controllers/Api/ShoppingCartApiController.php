<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductAttribute;
use App\Models\Price;
use App\Traits\ShoppingCartTrait;
use Illuminate\Http\Request;
use Validator;
use DB;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;


class ShoppingCartApiController extends Controller
{
    use ShoppingCartTrait;

    public function index(Request $request)
    {
        //TODO
        //DB Storage
        $data = [];

        try {
            // $data = $this->getCart($request);
            $data = $request->session()->get('cart');
        } catch (Exception $e) {
            Log::error('Shopping Cart Index Error: '. $e->getMessage());
        }

        return $data;
    }

    public function addProductToCart(Product $product, Request $request)
    {

        try {

            $imagePath = $product->images->first()?->path;


            $imageUrl = asset('/storage/' . $imagePath);

            $product_data = [
                'id' => $product->id,
                'quantity' => 1,
                'name' => $product->name,
                'price' => $product->price->price,
                'price_currency' => 'BGN',
                'image' => $imageUrl
            ];

            $this->addToCart($product_data, $request);

        } catch (Exception $e) {
            Log::error('Shopping Cart Add Error: '. $e->getMessage());
        }

        return response()->json($product_data);
    }

    public function removeProductFromCart(Product $product, Request $request)
    {
        try {
            $this->removeFromCart($product, $request);
        } catch(Exception $e) {
            Log::error('Shopping Cart Remove Error: '. $e->getMessage());
        }

        return true;
    }

    public function emptyUserCart(Request $request)
    {
        try {
            $this->emptyCart($request);
        } catch(Exception $e) {
            Log::error('Shopping Cart Empty Error: '. $e->getMessage());
        }

        return true;
    }

    public function updateQuantity(Request $request)
    {
        $productId = $request->input('productId');
        $quantity = (int) $request->input('quantity'); // Ensure quantity is treated as integer

        // Assuming 'cart' structure is correct and 'products' key exists
        $cart = session('cart', []);
        Log::info('Cart before update:', ['cart' => $cart]);

        if (isset($cart['products'][$productId])) { // Adjusted access pattern
            $cart['products'][$productId]['quantity'] = max(1, $quantity);
            session(['cart' => $cart]);
            Log::info('Cart after update:', ['cart' => $cart]);

            return response()->json([
                'success' => true,
                'message' => 'Quantity updated',
            ]);
        } else {
            Log::info('Attempted to update quantity for non-existent product in cart.', ['productId' => $productId, 'cart' => $cart]);
            return response()->json([
                'success' => false,
                'message' => 'Product not found in cart',
            ]);
        }
    }


}
