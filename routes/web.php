<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Web\EventController;
use App\Http\Controllers\Web\RegistrationController;
use App\Http\Controllers\Admin\EventController as AdminEventController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\RegistrationController as AdminRegistrationController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

Route::get('/', [EventController::class, 'index'])->name('home');
Route::get('/events/{event}', [EventController::class, 'show'])->name('events.show');
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');

require __DIR__ . '/auth.php';

Route::middleware('auth')->group(function () {

    // Register to event
    Route::post('/events/{event}/register', [RegistrationController::class, 'store'])
        ->name('events.register');

    // Unregister
    Route::delete('/events/{event}/unregister', [RegistrationController::class, 'destroy'])
        ->name('events.unregister');

    // My registrations
    Route::get('/my-registrations', [RegistrationController::class, 'myRegistrations'])
        ->name('events.my-registrations');

    // My events
    Route::get('/my-events', [EventController::class, 'myEvents'])
        ->name('events.my-events');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
//Admin
Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {


        Route::resource('events', AdminEventController::class)->except(['show']);
        Route::resource('categories', AdminCategoryController::class)
            ->except(['show', 'create', 'edit']);

        Route::get('registrations', [AdminRegistrationController::class, 'index'])
            ->name('registrations.index');
    });
