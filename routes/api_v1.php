<?php

use App\Http\Controllers\API\V1\CategoryController;
use Illuminate\Support\Facades\Route;

Route::apiResource('categories', CategoryController::class)->except('store', 'show', 'update' , 'destroy');
// Route::apiResource()