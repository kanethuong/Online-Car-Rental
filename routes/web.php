<?php

use App\Http\Controllers\CartController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\DeliveryController;
use App\Http\Controllers\OrderController;

Route::get('/', [HomeController::class, 'index']) -> name('home');

Route::get('/redirect', [HomeController::class, 'redirect']);

Route::post('/add-cart', [CartController::class, 'addCart']);

Route::get('/load-cart-data', [CartController::class, 'cartLoad']);

Route::get('/cart', [CartController::class, 'index']);

Route::post('/update-cart', [CartController::class, 'updateCart']);

Route::post('/clear-cart', [CartController::class, 'clearCart']);

Route::post('/remove-cart-item', [CartController::class, 'removeCartItem']);

Route::get('/category/{id}', [CategoryController::class, 'index']);

Route::get('/sub-category/{id}', [SubCategoryController::class, 'index']);

Route::get('/delivery', [DeliveryController::class, 'index'])->name('delivery');

Route::post('/place-order', [DeliveryController::class, 'placeOrder']);

Route::get('/order-detail/{orderId}', [OrderController::class, 'orderDetail'])->name('order-detail');
