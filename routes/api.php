<?php

use App\Http\Controllers\UserController;

Route::middleware('auth:sanctum')->group(function() {
    Route::get('/me', [UserController::class, 'me']);
    Route::post('/logout', [UserController::class, 'logout']);
});

Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login']);
