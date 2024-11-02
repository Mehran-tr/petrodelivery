<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Authenticated routes (assuming you’re using Sanctum or other authentication)
Route::middleware(['auth:sanctum','ref_cors','custom_cors', 'check.token.expiration'])->group(function () {
    require_once __DIR__.'/company.php';
    require_once __DIR__.'/user.php';
    require_once __DIR__.'/client.php';
    require_once __DIR__.'/order.php';
    require_once __DIR__.'/delivery_truck.php';
    require __DIR__ . '/locations.php';
});

Route::middleware(['custom_cors','ref_cors'])->group(function () {

    require_once __DIR__.'/auth.php';
});
