<?php

use App\Http\Controllers\API\V1\CategoryController;
use App\Http\Controllers\API\V1\ProductController;
use Illuminate\Support\Facades\Route;

Route::apiResource('categories', CategoryController::class)->except('store', 'show', 'update' , 'destroy');
Route::apiResource('products', ProductController::class);