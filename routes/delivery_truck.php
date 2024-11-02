<?php
use App\Http\Controllers\api\DeliveryTruckController;
use Illuminate\Support\Facades\Route;


Route::middleware(['admin', 'company.access'])->group(function () {
    Route::get('/trucks', [DeliveryTruckController::class, 'index']);            // List all trucks
    Route::get('/trucks/{id}', [DeliveryTruckController::class, 'show']);         // Get a single truck
    Route::post('/trucks', [DeliveryTruckController::class, 'store']);            // Create a new truck
    Route::put('/trucks/{id}', [DeliveryTruckController::class, 'update']);       // Update a truck
    Route::delete('/trucks/{id}', [DeliveryTruckController::class, 'destroy']);   // Delete a truck
});
