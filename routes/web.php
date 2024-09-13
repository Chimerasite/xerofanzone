<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ForagingController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Foraging
Route::get('/statistics/foraging', [ForagingController::class, 'foragingShow'])->name('stats.foraging');
Route::get('/edit', [ForagingController::class, 'foragingEdit'])->middleware(['auth', 'admin'])->name('stats.foraging-edit');
Route::get('foraging/add', [ForagingController::class, 'foragingAdd'])->middleware(['auth'])->name('stats.foraging-add');


require __DIR__.'/auth.php';
