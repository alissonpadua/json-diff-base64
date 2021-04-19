<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JsonLeftController;

Route::prefix('v1/diff')->group(function () {
    Route::post('{id}/left', [JsonLeftController::class, 'store']);
});
