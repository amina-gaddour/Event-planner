<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\EventController;
use App\Http\Controllers\Api\RegistrationController;
use App\Http\Controllers\Api\AdminRegistrationController;

// PUBLIC
Route::get('/events', [EventController::class, 'index']);
Route::get('/events/{event}', [EventController::class, 'show']);
Route::get('/categories', [CategoryController::class, 'index']);

// AUTH USER (connecté)
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/me/registrations', [RegistrationController::class, 'myRegistrations']);
    Route::post('/events/{event}/register', [RegistrationController::class, 'register']);
    Route::delete('/events/{event}/unregister', [RegistrationController::class, 'unregister']);

    // ADMIN ONLY
    Route::middleware('admin')->group(function () {
        // Categories CRUD
        Route::post('/categories', [CategoryController::class, 'store']);
        Route::put('/categories/{category}', [CategoryController::class, 'update']);
        Route::delete('/categories/{category}', [CategoryController::class, 'destroy']);

        // Events CRUD
        Route::post('/events', [EventController::class, 'store']);
        Route::put('/events/{event}', [EventController::class, 'update']);
        Route::delete('/events/{event}', [EventController::class, 'destroy']);

        // Admin registrations
        Route::get('/admin/registrations', [AdminRegistrationController::class, 'index']);
    });
});
