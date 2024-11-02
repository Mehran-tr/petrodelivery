<?php
use App\Http\Controllers\api\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum', 'admin'])->prefix('users')->group(function () {
    Route::get('/', [UserController::class, 'index']);      // List all users
    Route::post('/', [UserController::class, 'store']);     // Create a new user
    Route::get('{id}', [UserController::class, 'show']);    // View a single user
    Route::put('{id}', [UserController::class, 'update']);  // Update user details
    Route::delete('{id}', [UserController::class, 'destroy']); // Delete a user
});
