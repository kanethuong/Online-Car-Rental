<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

Route::get('/',[HomeController::class,'index']);

Route::get('/redirect',[HomeController::class,'redirect']);

Route::get('/add_cart/{product_id}',[HomeController::class,'add_cart']);
