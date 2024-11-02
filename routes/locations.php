<?php
use App\Http\Controllers\api\LocationController;
use Illuminate\Support\Facades\Route;

Route::middleware([ 'company.access'])->group(function () {
    Route::post('/locations', [LocationController::class, 'store']);
});
