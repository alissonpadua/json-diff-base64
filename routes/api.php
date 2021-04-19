<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JsonLeftController;
use App\Http\Controllers\JsonRightController;

Route::prefix('v1/diff')->group(function () {
    Route::post('{id}/left', [JsonLeftController::class, 'store']);
    Route::post('{id}/right', [JsonRightController::class, 'store']);
});
