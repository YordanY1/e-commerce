<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ManufacturerApiController;
use App\Http\Controllers\Api\ProductsApiController;
use App\Http\Controllers\Api\CategoriesApiController;
use App\Http\Controllers\Api\ShoppingCartApiController;
use App\Http\Controllers\MailController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


// Manufacturer API Routes
Route::get('/manufacturers', [ManufacturerApiController::class, 'index']);
Route::get('/manufacturers/{id}', [ManufacturerApiController::class, 'show']);
Route::post('/manufacturers', [ManufacturerApiController::class, 'store']);
Route::put('/manufacturers/{id}', [ManufacturerApiController::class, 'update']);
Route::delete('/manufacturers/{id}', [ManufacturerApiController::class, 'destroy']);

// Product API Routes
Route::get('/products', [ProductsApiController::class, 'index']);
Route::get('/products/{id}', [ProductsApiController::class, 'show']);
Route::post('/products', [ProductsApiController::class, 'store']);
Route::put('/products/{id}', [ProductsApiController::class, 'update']);
Route::delete('/products/{id}', [ProductsApiController::class, 'destroy']);

// Category API Routes
Route::get('/categories', [CategoriesApiController::class, 'index']);
Route::get('/categories/{id}', [CategoriesApiController::class, 'show']);
Route::post('/categories', [CategoriesApiController::class, 'store']);
Route::put('/categories/{id}', [CategoriesApiController::class, 'update']);
Route::delete('/categories/{id}', [CategoriesApiController::class, 'destroy']);

//Emails
Route::post('/send-email', [MailController::class, 'sendEmail']);

//Shopping Cart API Routes
Route::get('/shopping-cart', [ShoppingCartApiController::class, 'index']);
Route::post('/shopping-cart/add-to-cart/{product}', [ShoppingCartApiController::class, 'addToCart']);
Route::post('/shopping-cart/remove-from-cart/{product}', [ShoppingCartApiController::class, 'removeFromCart']);
Route::post('/shopping-cart/empty-cart', [ShoppingCartApiController::class, 'emptyCart']);
