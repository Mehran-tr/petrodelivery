<?php

use App\Http\Controllers\api\OrderController;
use Illuminate\Support\Facades\Route;


Route::middleware(['company.access'])->group(function () {
    Route::get('/orders', [OrderController::class, 'index']);             // List all orders
    Route::get('/orders/{id}', [OrderController::class, 'show']);          // Get a single order
    Route::post('/orders', [OrderController::class, 'store']);             // Create a new order
    Route::put('/orders/{id}', [OrderController::class, 'update']);        // Update an order
    Route::delete('/orders/{id}', [OrderController::class, 'destroy']);    // Delete an order
});
