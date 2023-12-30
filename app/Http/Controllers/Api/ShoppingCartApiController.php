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

class ShoppingCartApiController extends Controller
{
    use ShoppingCartTrait;

    public function index(Request $request)
    {
        //TODO
        //DB Storage
        try {
            $data = $this->getCart($request);
        } catch (Exception $e) {
            Log::error('Shopping Cart Index Error: '. $e->getMessage());
        }

        return $data;
    }

    public function addToCart(Product $product, Request $request)
    {
        try {
            $this->addToCart($product, $request);
        } catch (Exception $e) {
            Log::error('Shopping Cart Add Error: '. $e->getMessage());
        }

        return true;
    }

    public function removeFromCart(Product $product, Request $request)
    {
        try {
            $this->removeFromCart($product, $request);
        } catch(Exception $e) {
            Log::error('Shopping Cart Remove Error: '. $e->getMessage());
        }

        return true;
    }

    public function emptyCart(Request $request)
    {
        try {
            $this->emptyCart($request);
        } catch(Exception $e) {
            Log::error('Shopping Cart Empty Error: '. $e->getMessage());
        }
        
        return true;
    }

}