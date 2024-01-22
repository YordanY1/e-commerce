<?php

use App\Http\Controllers\Admin\CategoriesController;
use App\Http\Controllers\Admin\ManufacturersController;
use App\Http\Controllers\Admin\PanelController;
use App\Http\Controllers\Admin\ProductsController;
use App\Http\Controllers\Admin\UsersController;
use Illuminate\Support\Facades\Route;

//Admin panel Login
Route::get('/', [PanelController::class, 'index'])->name('admin.panel');
//Admin panel Pages
Route::prefix('admin')->middleware('auth')->group(function () {
    Route::resource('products', ProductsController::class)->names('admin.products');
    Route::resource('manufacturers', ManufacturersController::class)->names('admin.manufacturers');
    Route::resource('categories', CategoriesController::class)->names('admin.categories');
    Route::resource('users', UsersController::class)->names('admin.users');
});
