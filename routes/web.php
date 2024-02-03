<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;

use App\Http\Controllers\Admin\PanelController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Admin\ProductsController as AdminProductsController;
use App\Http\Controllers\Admin\ManufacturersController;
use App\Http\Controllers\Admin\CategoriesController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Payment\PaymentBankController;
use App\Http\Controllers\Payment\PaymentDataController;
use App\Http\Controllers\Payment\PaymentFailedController;
use App\Http\Controllers\Payment\PaymentStripeController;
use App\Http\Controllers\Payment\PaymentSuccessController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//Home
Route::get('/', [HomeController::class, 'index']);

//About
Route::get('/about', [AboutController::class, 'index']);

//Contacts
Route::get('/contact', [ContactController::class, 'index']);

//Products
Route::get('/products', [ProductsController::class, 'index']);

//Products by ID
Route::get('/product/{slug}', [ProductController::class, 'show']);

//Cart
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');

//Checkout
Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
Route::get('payment/checkout', [PaymentDataController::class, 'index']);
Route::post('payment/stripe', [PaymentStripeController::class,'sendPayment']);
Route::post('payment/bank', [PaymentBankController::class,'sendPayment']);
Route::get('payment/success', [PaymentSuccessController::class, 'index']);
Route::get('payment/failed', [PaymentFailedController::class, 'index']);

//Login Register
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register']);
Route::post('logout', [LogoutController::class, 'logout'])->name('logout');


//Admin panel
// Route::prefix('admin')->middleware('auth')->group(function () {
//     Route::get('/panel', [PanelController::class, 'index'])->name('admin.panel');

//     Route::resource('products', AdminProductsController::class)->names('admin.products');
//     Route::resource('manufacturers', ManufacturersController::class)->names('admin.manufacturers');
//     Route::resource('categories', CategoriesController::class)->names('admin.categories');
//     Route::resource('users', UsersController::class)->names('admin.users');
// });
