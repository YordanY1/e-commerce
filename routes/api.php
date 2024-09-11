<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ManufacturerApiController;
use App\Http\Controllers\Api\ProductsApiController;
use App\Http\Controllers\Api\CategoriesApiController;
use App\Http\Controllers\Api\ShoppingCartApiController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\EcontController;
use App\Http\Controllers\ReviewController;



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
// Route::get('/manufacturers', [ManufacturerApiController::class, 'index']);
// Route::get('/manufacturers/{id}', [ManufacturerApiController::class, 'show']);
// Route::post('/manufacturers', [ManufacturerApiController::class, 'store']);
// Route::put('/manufacturers/{id}', [ManufacturerApiController::class, 'update']);
// Route::delete('/manufacturers/{id}', [ManufacturerApiController::class, 'destroy']);

// Product API Routes
// Route::get('/products', [ProductsApiController::class, 'index']);
// Route::get('/products/{id}', [ProductsApiController::class, 'show']);
// Route::post('/products', [ProductsApiController::class, 'store']);
// Route::put('/products/{id}', [ProductsApiController::class, 'update']);
// Route::delete('/products/{id}', [ProductsApiController::class, 'destroy']);

// Category API Routes
// Route::get('/categories', [CategoriesApiController::class, 'index']);
// Route::get('/categories/{id}', [CategoriesApiController::class, 'show']);
// // Route::post('/categories', [CategoriesApiController::class, 'store'])->name('categories.store');
// Route::put('/categories/{id}', [CategoriesApiController::class, 'update']);
// Route::delete('/categories/{id}', [CategoriesApiController::class, 'destroy']);


//Shopping Cart API Routes
Route::get('/shopping-cart', [ShoppingCartApiController::class, 'index']);
Route::post('/shopping-cart/add-to-cart/{product}', [ShoppingCartApiController::class, 'addProductToCart'])->middleware('web');
Route::post('/shopping-cart/remove-from-cart/{product}', [ShoppingCartApiController::class, 'removeProductFromCart'])->middleware('web');
Route::post('/shopping-cart/empty-cart', [ShoppingCartApiController::class, 'emptyUserCart']);
Route::post('/shopping-cart/update', [ShoppingCartApiController::class, 'updateQuantity'])->name('cart.update')->middleware('web');


// //Shipment API Routes
// Route::get('/econt/offices', [EcontController::class, 'getOffices']);
// Route::post('/econt/labels/create', [EcontController::class, 'createLabel'])->name('econt.labels.create');


//Review
Route::post('/reviews/store', [ReviewController::class, 'store'])->name('reviews.store');

