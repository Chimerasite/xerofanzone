<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ForagingController;
use App\Http\Controllers\CometController;
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
Route::get('/statistics/foraging', [ForagingController::class, 'Show'])->name('stats.foraging');
Route::get('/statistics/foraging/edit', [ForagingController::class, 'Edit'])->middleware(['auth', 'admin'])->name('stats.foraging-edit');
Route::get('/statistics/foraging/add', [ForagingController::class, 'Add'])->middleware(['auth'])->name('stats.foraging-add');

// Foraging
Route::get('/statistics/cometclusters', [CometController::class, 'Show'])->name('stats.comets');
Route::get('/statistics/cometclusters/add', [CometController::class, 'Add'])->middleware(['auth'])->name('stats.comets-add');
Route::get('/statistics/cometclusters/calculator', [CometController::class, 'Math'])->name('stats.comets-math');


require __DIR__.'/auth.php';
