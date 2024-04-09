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

}
