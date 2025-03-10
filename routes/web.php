<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TripController;
use App\Http\Controllers\AvailabilityController;
use App\Http\Controllers\ProfileController;

Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth'])
    ->name('dashboard');

// Trips
Route::resource('trips', TripController::class)
    ->middleware(['auth']);

Route::patch('/trips/{trip}/update-status', [TripController::class, 'updateStatus'])
    ->name('trips.update-status')
    ->middleware('auth');

// Availability (for drivers)
Route::resource('availability', AvailabilityController::class)
    ->middleware(['auth', 'role:driver']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';