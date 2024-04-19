<?php

use App\Http\Controllers\CartController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

Route::get('/',[HomeController::class,'index']);

Route::get('/redirect',[HomeController::class,'redirect']);

Route::post('/add-cart',[CartController::class,'addCart']);

Route::get('/load-cart-data',[CartController::class,'cartLoad']);

Route::get('/cart',[CartController::class,'index']);

Route::post('/update-cart',[CartController::class,'updateCart']);

