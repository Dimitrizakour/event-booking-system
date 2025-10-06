<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\UserController;

// Public routes
Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login']);

// Protected routes (authenticated users)
Route::middleware(['auth:sanctum'])->group(function () {

    // User routes
    Route::get('/me', [UserController::class, 'me']);
    Route::post('/logout', [UserController::class, 'logout']);

    // Events
    Route::get('events', [EventController::class, 'index']); // everyone can see
    Route::get('events/{id}', [EventController::class, 'show']); // everyone can see
    Route::middleware(['role:admin,organizer'])->group(function () {
        Route::post('events', [EventController::class, 'store']);
        Route::put('events/{id}', [EventController::class, 'update']);
        Route::delete('events/{id}', [EventController::class, 'destroy']);
    });

    // Tickets
    Route::middleware(['role:admin,organizer'])->group(function () {
        Route::post('events/{event_id}/tickets', [TicketController::class, 'store']);
        Route::put('tickets/{id}', [TicketController::class, 'update']);
        Route::delete('tickets/{id}', [TicketController::class, 'destroy']);
    });

    // Bookings
    Route::middleware(['role:customer'])->group(function () {
        Route::post('tickets/{id}/bookings', [BookingController::class, 'store']);
        Route::get('bookings', [BookingController::class, 'index']);
        Route::put('bookings/{id}/cancel', [BookingController::class, 'cancel']);
        Route::post('bookings/{id}/payment', [PaymentController::class, 'pay']);
        Route::get('payments/{id}', [PaymentController::class, 'show']);
    });

});
