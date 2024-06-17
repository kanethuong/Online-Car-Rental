<?php

use App\Http\Controllers\CartController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\DeliveryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ReservationController;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/reservation', [ReservationController::class, 'index']);

Route::post('/add-reservation', [ReservationController::class, 'addReservation']);

Route::post('/place-order', [OrderController::class, 'placeOrder'])->name('place-order');

Route::get('/order-confirmation', [OrderController::class, 'orderConfirmation'])->name('order-confirmation');

Route::get('/cancel-order', [OrderController::class, 'cancelOrder']);

Route::get('/search-suggestions', [HomeController::class, 'searchSuggestions']);

Route::get('/category/type/{id}', [CategoryController::class, 'getCarsByType']);

Route::get('/category/brand/{id}', [CategoryController::class, 'getCarsByBrand']);
