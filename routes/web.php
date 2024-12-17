<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ForagingController;
use App\Http\Controllers\CometController;
use App\Http\Controllers\FanCreationController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name('home');

//Profile
Route::get('/profile', function () {
    return view('profile.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/settings', [ProfileController::class, 'edit'])->name('settings.edit');
    Route::patch('/settings', [ProfileController::class, 'update'])->name('settings.update');
    Route::delete('/settings', [ProfileController::class, 'destroy'])->name('settings.destroy');
});

// Foraging
Route::get('/statistics/foraging', [ForagingController::class, 'Index'])->name('stats.foraging');
Route::get('/statistics/foraging/update', [ForagingController::class, 'Update'])->middleware(['auth'])->name('stats.foraging-update');
Route::get('/statistics/foraging/edit', [ForagingController::class, 'Edit'])->middleware(['auth', 'admin'])->name('stats.foraging-edit');

// Comets
Route::get('/statistics/cometclusters', [CometController::class, 'Index'])->name('stats.comets');
Route::get('/statistics/cometclusters/update', [CometController::class, 'Update'])->middleware(['auth'])->name('stats.comets-update');
Route::get('/statistics/cometclusters/calculator', [CometController::class, 'Math'])->name('stats.comets-math');

// Creations
Route::get('/fan-creations', [FanCreationController::class, 'Index'])->name('fancreations');
Route::get('/fan-creations/create', [FanCreationController::class, 'Create'])->middleware(['auth'])->name('fancreations-create');
Route::get('/fan-creations/{post:slug}', [FanCreationController::class, 'Show'])->name('fancreations-show');
Route::get('/fan-creations/{post:slug}/edit', [FanCreationController::class, 'Edit'])->middleware(['auth', 'post_owner:{post:slug}'])->name('fancreations-edit');



require __DIR__.'/auth.php';
