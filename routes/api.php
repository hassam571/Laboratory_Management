<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\LoyaltyController;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Loyalty Discount API endpoint
Route::get('/loyalty-discount', [LoyaltyController::class, 'getDiscount']);