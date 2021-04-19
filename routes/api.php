<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JsonLeftController;
use App\Http\Controllers\JsonRightController;
use App\Http\Controllers\JsonCompareController;

Route::prefix('v1/diff')->group(function () {
    Route::post('{id}/left', [JsonLeftController::class, 'store']);
    Route::post('{id}/right', [JsonRightController::class, 'store']);
    Route::get('{id}', [JsonCompareController::class, 'compare']);
});
