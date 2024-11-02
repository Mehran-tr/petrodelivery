<?php
use App\Http\Controllers\api\CompanyController;
use Illuminate\Support\Facades\Route;


Route::middleware(['auth:sanctum', 'admin'])->prefix('companies')->group(function () {
    Route::get('/', [CompanyController::class, 'index']);      // List all companies
    Route::post('/', [CompanyController::class, 'store']);     // Create a new company
    Route::get('{id}', [CompanyController::class, 'show']);    // View a single company
    Route::put('{id}', [CompanyController::class, 'update']);  // Update company details
    Route::delete('{id}', [CompanyController::class, 'destroy']); // Delete a company
});
