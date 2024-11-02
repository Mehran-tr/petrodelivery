<?php
use App\Http\Controllers\api\ClientController;
use Illuminate\Support\Facades\Route;



Route::middleware(['company.access'])->group(function () {
    Route::get('/clients', [ClientController::class, 'index']);           // List all clients
    Route::get('/clients/{id}', [ClientController::class, 'show']);        // Get a single client
    Route::post('/clients', [ClientController::class, 'store']);           // Create a new client
    Route::put('/clients/{id}', [ClientController::class, 'update']);      // Update a client
    Route::delete('/clients/{id}', [ClientController::class, 'destroy']);  // Delete a client
});
