<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\Services;
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
use App\Http\Controllers\Api\StripePaymentApiController;
use App\Http\Controllers\Payment\PaymentBankController;
use App\Http\Controllers\Payment\PaymentDataController;
use App\Http\Controllers\Payment\PaymentFailedController;
use App\Http\Controllers\Payment\PaymentStripeController;
use App\Http\Controllers\Payment\PaymentSuccessController;
use App\Http\Controllers\Payment\StripePaymentGeneralController;
use App\Http\Controllers\CashOnDeliveryController;
use App\Http\Controllers\CatBotController;

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

//Services
Route::get('/services', [Services::class, 'index'])->name('services.index');

//Contacts
Route::get('/contact', [ContactController::class, 'index']);
Route::post('/send-email', [ContactController::class, 'sendEmail'])->name('send-email');

//Products
Route::get('/products', [ProductsController::class, 'index']);
Route::get('/ajax-search', [ProductsController::class, 'ajaxSearch'])->name('ajax.search');
Route::get('/category/{slug}', [ProductsController::class, 'showCategory'])->name('category.show');


//Terms
Route::get('/terms', [App\Http\Controllers\TermsController::class, 'index'])->name('terms.index');


//Products by ID
Route::get('/product/{slug}', [ProductController::class, 'show']);

//Cart
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');

//Checkout
Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
Route::post('/payment', [CheckoutController::class, 'processPayment'])->name('checkout.process')->middleware('web');
Route::post('/checkout/cash-on-delivery', [CashOnDeliveryController::class, 'processOrder'])->name('checkout.cod');


Route::get('/checkout/success', function () {
return view('checkout.success');
})->name('checkout.success');

Route::get('/checkout/failure', function () {
    return view('checkout.failure');
})->name('checkout.failure');


// Route::get('payment/checkout', [PaymentDataController::class, 'index']);
// Route::post('payment/stripe', [PaymentStripeController::class,'sendPayment']);
// Route::post('payment/bank', [PaymentBankController::class,'sendPayment']);
// Route::get('payment/success', [PaymentSuccessController::class, 'index']);
// Route::get('payment/failed', [PaymentFailedController::class, 'index']);

//Stripe
// Route::get('stripe/charge', [CheckoutController::class, 'stripeCharge']);
// Route::post('stripe/charge', [StripePaymentGeneralController::class, 'charge']);



// Apply whitelist middleware to login and registration routes
Route::middleware(['whitelist'])->group(function () {
    Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('login', [LoginController::class, 'login']);
    Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('register', [RegisterController::class, 'register']);
    Route::post('logout', [LogoutController::class, 'logout'])->name('logout');
});

//Admin panel with IP Whitelist and Authentication
Route::prefix('admin')->middleware(['auth', 'whitelist'])->group(function () {
    Route::get('/panel', [PanelController::class, 'index'])->name('admin.panel');

    Route::resource('products', AdminProductsController::class)->names('admin.products');
    Route::resource('manufacturers', ManufacturersController::class)->names('admin.manufacturers');
    Route::resource('categories', CategoriesController::class)->names('admin.categories');
    Route::resource('users', UsersController::class)->names('admin.users');
});

Route::post('/catbot/respond', [CatBotController::class, 'respond']);
Route::get('/catbot/questions', [CatBotController::class, 'getQuestions']);


